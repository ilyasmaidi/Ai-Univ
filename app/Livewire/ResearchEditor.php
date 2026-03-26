<?php

namespace App\Livewire;

use App\Models\Research;
use App\Models\ResearchSection;
use App\Services\AIService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.app-layout')]
class ResearchEditor extends Component
{
    public Research $research;
    public $activeSectionId;
    public $content = '';
    public bool $isGenerating = false;

    public function mount($slug)
    {
        $this->research = Research::where('slug', $slug)->firstOrFail();
        $this->activeSectionId = $this->research->sections()->first()?->id;
        $this->loadSectionContent();
    }

    public function selectSection($id)
    {
        $this->saveCurrentContent();
        $this->activeSectionId = $id;
        $this->loadSectionContent();
    }

    public function loadSectionContent()
    {
        $section = ResearchSection::find($this->activeSectionId);
        $this->content = $section?->content ?? '';
    }

    public function saveCurrentContent()
    {
        if ($this->activeSectionId) {
            ResearchSection::where('id', $this->activeSectionId)->update([
                'content' => $this->content
            ]);
        }
    }

    public function generateSectionContent()
    {
        $this->isGenerating = true;
        
        $section = ResearchSection::find($this->activeSectionId);
        $aiService = app(AIService::class);
        
        $references = $this->research->references->toArray();
        
        $this->content = $aiService->generateSectionContent(
            $this->research->title,
            $section->title,
            $section->type,
            $references,
            $this->research->language
        );

        $this->saveCurrentContent();
        $this->isGenerating = false;
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            ResearchSection::where('id', $item['value'])->update(['order' => $item['order']]);
        }
        $this->research->load('sections');
    }

    public function render()
    {
        return view('livewire.research-editor');
    }
}
