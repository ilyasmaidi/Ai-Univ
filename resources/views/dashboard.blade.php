<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('لوحة التحكم') }}
        </h2>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900">{{ __('أبحاثي الأكاديمية') }}</h3>
                <a href="{{ route('research.create') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all flex items-center">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('بدء بحث جديد') }}
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse(\App\Models\Research::where('user_id', auth()->id())->latest()->get() as $research)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold">{{ $research->subject }}</span>
                            <span class="text-xs text-gray-400">{{ $research->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2 truncate">{{ $research->title }}</h4>
                        <p class="text-sm text-gray-500 mb-6">{{ $research->university }}</p>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('research.editor', $research->slug) }}" class="flex-grow py-2 bg-gray-50 text-gray-700 rounded-lg text-sm font-bold text-center hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                {{ __('تحرير') }}
                            </a>
                            <a href="{{ route('research.export', $research->slug) }}" class="p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900">{{ __('لا توجد أبحاث بعد') }}</h4>
                        <p class="text-gray-500 mt-1 mb-6">{{ __('ابدأ رحلتك البحثية اليوم باستخدام الذكاء الاصطناعي') }}</p>
                        <a href="{{ route('research.create') }}" class="inline-flex items-center px-8 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all">
                            {{ __('إنشاء أول بحث الآن') }}
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
