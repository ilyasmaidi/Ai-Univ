<?php

namespace App\Livewire;

use App\Models\Research;
use App\Models\ResearchSection;
use App\Models\Reference;
use App\Services\AIService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.app-layout')]
class ResearchWizard extends Component
{
    public int $step = 1;

    // Step 1: Meta
    public string $title = '';
    public string $subject = '';
    public string $university = '';
    public string $faculty = '';
    public string $student_name = '';
    public string $teacher_name = '';
    public string $language = 'ar';

    // Step 2: AI Plan
    public array $sections = [];
    public bool $generatingPlan = false;

    // Step 3: References
    public array $references = [];
    public string $newAuthor = '';
    public string $newTitle = '';
    public string $newYear = '';

    protected function rules()
    {
        return [
            1 => [
                'title' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                'university' => 'required|string|max:255',
                'faculty' => 'required|string|max:255',
                'student_name' => 'required|string|max:255',
                'teacher_name' => 'required|string|max:255',
            ],
            2 => [
                'sections' => 'required|array|min:1',
            ],
            3 => [
                'references' => 'array',
            ],
        ][$this->step] ?? [];
    }

    public function nextStep()
    {
        $this->validate($this->rules());
        
        if ($this->step === 1) {
            $this->generateAIPlan();
        }

        if ($this->step < 3) {
            $this->step++;
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function generateAIPlan()
    {
        $this->generatingPlan = true;
        $aiService = app(AIService::class);
        $this->sections = $aiService->generateTableOfContents($this->title, $this->subject, $this->language);
        $this->generatingPlan = false;
    }

    public function addSection()
    {
        $this->sections[] = [
            'title' => '',
            'type' => 'chapter',
        ];
    }

    public function removeSection($index)
    {
        unset($this->sections[$index]);
        $this->sections = array_values($this->sections);
    }

    public function addReference()
    {
        $this->validate([
            'newAuthor' => 'required|string',
            'newTitle' => 'required|string',
            'newYear' => 'required|digits:4',
        ]);

        $this->references[] = [
            'author' => $this->newAuthor,
            'title' => $this->newTitle,
            'year' => $this->newYear,
        ];

        $this->reset(['newAuthor', 'newTitle', 'newYear']);
    }

    public function removeReference($index)
    {
        unset($this->references[$index]);
        $this->references = array_values($this->references);
    }

    public function saveResearch()
    {
        $this->validate($this->rules());

        $research = Research::create([
            'user_id' => Auth::id() ?? 1, // Fallback to 1 for dev
            'title' => $this->title,
            'subject' => $this->subject,
            'university' => $this->university,
            'faculty' => $this->faculty,
            'student_name' => $this->student_name,
            'teacher_name' => $this->teacher_name,
            'language' => $this->language,
            'status' => 'draft',
        ]);

        foreach ($this->sections as $index => $section) {
            $research->sections()->create([
                'title' => $section['title'],
                'type' => $section['type'],
                'order' => $index,
            ]);
        }

        foreach ($this->references as $ref) {
            $research->references()->create($ref);
        }

        return redirect()->route('research.editor', $research->slug);
    }

    public function render()
    {
        return view('livewire.research-wizard');
    }
}
