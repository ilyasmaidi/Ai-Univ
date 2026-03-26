<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'الإعدادات';
    protected static ?string $title = 'إعدادات النظام';
    protected static ?int $navigationSort = 100;

    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'gemini_api_key' => Setting::get('gemini_api_key'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('إعدادات الذكاء الاصطناعي')
                    ->description('أدخل مفاتيح API الخاصة بخدمات الذكاء الاصطناعي')
                    ->schema([
                        TextInput::make('gemini_api_key')
                            ->label('مفتاح Gemini API')
                            ->password()
                            ->revealable()
                            ->required()
                            ->helperText('احصل على مفتاح مجاني من Google AI Studio.'),
                    ])
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('حفظ الإعدادات')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            foreach ($data as $key => $value) {
                Setting::set($key, $value);
            }

            Notification::make()
                ->success()
                ->title('تم الحفظ')
                ->body('تم حفظ الإعدادات بنجاح.')
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('خطأ')
                ->body('حدث خطأ أثناء حفظ الإعدادات.')
                ->send();
        }
    }
}
