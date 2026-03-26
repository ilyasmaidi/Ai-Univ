<div class="h-screen flex bg-gray-100 overflow-hidden" dir="{{ $research->language === 'ar' ? 'rtl' : 'ltr' }}" x-data="{ saving: false }">
    {{-- Sidebar --}}
    <div class="w-80 bg-white border-l border-gray-200 flex flex-col shadow-sm">
        <div class="p-6 border-b border-gray-100 bg-blue-600 text-white">
            <h1 class="text-xl font-bold truncate">{{ $research->title }}</h1>
            <p class="text-blue-100 text-xs mt-1">{{ $research->subject }}</p>
        </div>
        
        <div class="flex-grow overflow-y-auto p-4 space-y-2">
            @foreach($research->sections as $section)
                <button 
                    wire:click="selectSection({{ $section->id }})"
                    class="w-full flex items-center p-3 rounded-xl transition-all duration-200 text-right group {{ $activeSectionId == $section->id ? 'bg-blue-50 border border-blue-200 text-blue-700 shadow-sm' : 'hover:bg-gray-50 text-gray-600' }}"
                >
                    <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full text-[10px] font-bold ml-3 {{ $activeSectionId == $section->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-500' }}">
                        {{ $loop->iteration }}
                    </span>
                    <span class="flex-grow text-sm font-medium truncate">{{ $section->title }}</span>
                    @if($section->content)
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    @endif
                </button>
            @endforeach
        </div>

        <div class="p-4 border-t border-gray-100 space-y-2 bg-gray-50">
            <a href="{{ route('research.export', $research->slug) }}" class="w-full py-2.5 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition-all flex items-center justify-center shadow-lg shadow-green-100">
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                {{ __('تصدير البحث (PDF)') }}
            </a>
            <a href="{{ route('dashboard') }}" class="w-full py-2.5 text-gray-600 hover:text-blue-600 transition-colors flex items-center justify-center text-sm font-medium">
                {{ __('العودة للوحة التحكم') }}
            </a>
        </div>
    </div>

    {{-- Editor Area --}}
    <div class="flex-grow flex flex-col bg-white">
        {{-- Header Actions --}}
        <div class="px-8 py-4 border-b border-gray-100 flex justify-between items-center bg-white shadow-sm z-10">
            <div>
                <h2 class="text-lg font-bold text-gray-800">
                    {{ $research->sections->firstWhere('id', $activeSectionId)?->title }}
                </h2>
                <p class="text-xs text-gray-400 mt-0.5">
                    {{ __('جاري تحرير المحتوى الأكاديمي للقسم') }}
                </p>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center text-xs text-gray-400 ml-4" x-show="saving">
                    <div class="animate-spin rounded-full h-3 w-3 border-b-2 border-gray-400 ml-1"></div>
                    {{ __('جاري الحفظ...') }}
                </div>
                
                <button 
                    wire:click="generateSectionContent" 
                    wire:loading.attr="disabled"
                    class="flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-bold hover:bg-purple-700 transition-all disabled:opacity-50"
                >
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    {{ $isGenerating ? __('جاري التوليد...') : __('توليد المحتوى بالذكاء الاصطناعي') }}
                </button>

                <button 
                    wire:click="saveCurrentContent"
                    class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 transition-all"
                >
                    {{ __('حفظ القسم') }}
                </button>
            </div>
        </div>

        {{-- Editor --}}
        <div class="flex-grow relative bg-gray-50 overflow-hidden">
            @if($isGenerating)
                <div class="absolute inset-0 z-20 bg-white/80 backdrop-blur-sm flex flex-col items-center justify-center">
                    <div class="w-64 h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-purple-600 animate-pulse w-full"></div>
                    </div>
                    <p class="mt-4 text-purple-700 font-bold animate-pulse">{{ __('الذكاء الاصطناعي يقوم بكتابة القسم الآن...') }}</p>
                </div>
            @endif

            <textarea 
                wire:model.debounce.1000ms="content"
                class="w-full h-full p-12 bg-white border-none focus:ring-0 text-lg leading-relaxed text-gray-800 font-serif resize-none shadow-inner"
                placeholder="{{ __('ابدأ الكتابة هنا أو استخدم زر التوليد الذكي...') }}"
            ></textarea>
        </div>
    </div>
</div>
