<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    protected ?string $apiKey;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = Setting::get('gemini_api_key') ?? config('services.gemini.key');
    }

    /**
     * Generate a table of contents for a research.
     */
    public function generateTableOfContents(string $title, string $subject, string $language = 'ar'): array
    {
        if (!$this->apiKey) {
            Log::error("AIService Error: Gemini API Key is missing. Please set it in the admin settings.");
            return [];
        }
        $prompt = "As an academic research assistant, generate a structured table of contents for a research titled '{$title}' in the subject of '{$subject}'.
        The research should follow academic standards.
        Return the result as a JSON array of sections, where each section has a 'title' and 'type' (introduction, chapter, conclusion, bibliography).
        Language: {$language}.";

        try {
            $response = $this->callGemini($prompt);
            $sections = json_decode($this->extractJson($response), true);
            return is_array($sections) ? $sections : [];
        } catch (\Exception $e) {
            Log::error("AIService Error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Generate content for a specific section.
     */
    public function generateSectionContent(string $researchTitle, string $sectionTitle, string $type, array $references = [], string $language = 'ar'): string
    {
        if (!$this->apiKey) {
            return "خطأ: لم يتم إعداد مفتاح API الخاص بـ Gemini في لوحة التحكم.";
        }

        $refContext = !empty($references) ? "Use the following references: " . implode(', ', array_map(fn($r) => "{$r['author']} ({$r['year']}): {$r['title']}", $references)) : "";
        
        $prompt = "Write a comprehensive academic content for a section titled '{$sectionTitle}' (Type: {$type}) for a research titled '{$researchTitle}'.
        {$refContext}
        The content should be professional, academic, and well-structured.
        Language: {$language}.
        Return ONLY the markdown content.";

        try {
            return $this->callGemini($prompt);
        } catch (\Exception $e) {
            Log::error("AIService Error: " . $e->getMessage());
            return "Error generating content.";
        }
    }

    /**
     * Call Gemini API.
     */
    protected function callGemini(string $prompt): string
    {
        $response = Http::post("{$this->baseUrl}?key={$this->apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        if ($response->failed()) {
            throw new \Exception("Gemini API Request failed: " . $response->body());
        }

        return $response->json('candidates.0.content.parts.0.text') ?? '';
    }

    /**
     * Extract JSON from markdown response.
     */
    protected function extractJson(string $text): string
    {
        if (preg_match('/```json\s*(.*?)\s*```/s', $text, $matches)) {
            return $matches[1];
        }
        return $text;
    }
}
