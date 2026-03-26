<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8" dir="{{ $language === 'ar' ? 'rtl' : 'ltr' }}">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        {{-- Progress Bar --}}
        <div class="bg-gray-50 px-8 py-4 border-b border-gray-100">
            <div class="flex items-center justify-between relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full bg-gray-200 h-0.5"></div>
                    <div class="bg-blue-600 h-0.5 transition-all duration-500" @style(['width: ' . (($step - 1) * 50) . '%'])></div>
                </div>
                
                @foreach([1, 2, 3] as $i)
                    <div class="relative flex items-center justify-center w-10 h-10 rounded-full border-2 transition-colors duration-500 {{ $step >= $i ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                        @if($step > $i)
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="5 13l4 4L19 7"></path></svg>
                        @else
                            <span class="text-sm font-bold">{{ $i }}</span>
                        @endif
                        <span class="absolute -bottom-8 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium {{ $step >= $i ? 'text-blue-600' : 'text-gray-500' }}">
                            {{ [1 => __('المعلومات الأساسية'), 2 => __('خطة البحث'), 3 => __('المصادر والمراجع')][$i] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="p-8 mt-4">
            @if($step === 1)
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 border-r-4 border-blue-600 pr-4">{{ __('إعدادات البحث') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('عنوان البحث') }}</label>
                            <input type="text" wire:model="title" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3 shadow-sm" placeholder="{{ __('أدخل عنوان البحث كاملاً...') }}">
                            @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('المقياس / المادة') }}</label>
                            <input type="text" wire:model="subject" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3 shadow-sm" placeholder="{{ __('مثال: القانون الجنائي') }}">
                            @error('subject') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('اللغة') }}</label>
                            <select wire:model="language" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3 shadow-sm">
                                <option value="ar">العربية</option>
                                <option value="fr">Français</option>
                                <option value="en">English</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('الجامعة') }}</label>
                            <input type="text" wire:model="university" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3 shadow-sm">
                            @error('university') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('الكلية') }}</label>
                            <input type="text" wire:model="faculty" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3 shadow-sm">
                            @error('faculty') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('اسم الطالب') }}</label>
                            <input type="text" wire:model="student_name" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3 shadow-sm">
                            @error('student_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('اسم الأستاذ المشرف') }}</label>
                            <input type="text" wire:model="teacher_name" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3 shadow-sm">
                            @error('teacher_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            @endif

            @if($step === 2)
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 border-r-4 border-blue-600 pr-4">{{ __('خطة البحث المقترحة (AI)') }}</h2>
                    
                    @if($generatingPlan)
                        <div class="flex flex-col items-center justify-center py-12">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                            <p class="mt-4 text-gray-600 font-medium">{{ __('جاري توليد خطة البحث باستخدام الذكاء الاصطناعي...') }}</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($sections as $index => $section)
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200 group">
                                    <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full text-sm font-bold ml-4">
                                        {{ $index + 1 }}
                                    </span>
                                    <input type="text" wire:model="sections.{{ $index }}.title" class="flex-grow bg-transparent border-none focus:ring-0 font-medium text-gray-800">
                                    <select wire:model="sections.{{ $index }}.type" class="bg-white border border-gray-200 rounded-lg text-xs px-2 py-1 ml-2">
                                        <option value="introduction">{{ __('مقدمة') }}</option>
                                        <option value="chapter">{{ __('فصل') }}</option>
                                        <option value="conclusion">{{ __('خاتمة') }}</option>
                                        <option value="bibliography">{{ __('قائمة المراجع') }}</option>
                                    </select>
                                    <button wire:click="removeSection({{ $index }})" class="text-red-400 hover:text-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            @endforeach

                            <button wire:click="addSection" class="w-full py-3 border-2 border-dashed border-gray-300 rounded-xl text-gray-500 hover:border-blue-400 hover:text-blue-500 transition-colors flex items-center justify-center font-medium">
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="12 4v16m8-8H4"></path></svg>
                                {{ __('إضافة قسم جديد') }}
                            </button>
                        </div>
                    @endif
                </div>
            @endif

            @if($step === 3)
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 border-r-4 border-blue-600 pr-4">{{ __('المصادر والمراجع') }}</h2>
                    
                    <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('المؤلف') }}</label>
                                <input type="text" wire:model="newAuthor" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-2 shadow-sm">
                            </div>
                            <div class="md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('عنوان المرجع') }}</label>
                                <input type="text" wire:model="newTitle" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-2 shadow-sm">
                            </div>
                            <div class="md:col-span-1 flex items-end gap-2">
                                <div class="flex-grow">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('السنة') }}</label>
                                    <input type="text" wire:model="newYear" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-2 shadow-sm">
                                </div>
                                <button wire:click="addReference" class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-colors h-[42px] flex items-center px-4">
                                    {{ __('إضافة') }}
                                </button>
                            </div>
                        </div>
                        @error('newAuthor') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        @error('newTitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        @error('newYear') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-4">
                        @forelse($references as $index => $ref)
                            <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-xl hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $ref['title'] }}</p>
                                        <p class="text-sm text-gray-500">{{ $ref['author'] }} ({{ $ref['year'] }})</p>
                                    </div>
                                </div>
                                <button wire:click="removeReference({{ $index }})" class="text-red-400 hover:text-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500 italic">
                                {{ __('لا يوجد مراجع مضافة حالياً. يمكنك إضافة مراجع لمساعدة الذكاء الاصطناعي في البحث.') }}
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>

        {{-- Footer Actions --}}
        <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
            @if($step > 1)
                <button wire:click="previousStep" class="flex items-center px-6 py-2.5 text-sm font-bold text-gray-700 hover:text-blue-600 transition-colors">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $language === 'ar' ? 'M9 5l7 7-7 7' : 'M15 19l-7-7 7-7' }}"></path></svg>
                    {{ __('السابق') }}
                </button>
            @else
                <div></div>
            @endif

            @if($step < 3)
                <button wire:click="nextStep" class="flex items-center px-8 py-2.5 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                    {{ __('التالي') }}
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $language === 'ar' ? 'M15 19l-7-7 7-7' : 'M9 5l7 7-7 7' }}"></path></svg>
                </button>
            @else
                <button wire:click="saveResearch" class="flex items-center px-10 py-2.5 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 shadow-lg shadow-green-200 transition-all">
                    {{ __('ابدأ توليد البحث') }}
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </button>
            @endif
        </div>
    </div>
</div>
