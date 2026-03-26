<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إنجاز - منصة البحث العلمي الذكية</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cairo:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Cairo', sans-serif; }
        .hero-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="antialiased text-gray-800 selection:bg-blue-600 selection:text-white overflow-x-hidden">
    
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="font-bold text-2xl tracking-tight text-gray-900">إنجاز</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8 space-x-reverse">
                    <a href="#features" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">المميزات</a>
                    <a href="#how-it-works" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">كيف يعمل؟</a>
                    
                    <div class="flex items-center gap-4 mr-8 border-r border-gray-200 pr-8">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5">لوحة التحكم</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-bold transition-colors">تسجيل الدخول</a>
                            <a href="{{ route('login') }}" class="px-6 py-2.5 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5">ابدأ مجاناً</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 hero-pattern min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 font-semibold text-sm mb-8 border border-blue-100">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                مرحباً بك في مستقبل البحث الأكاديمي
            </div>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 tracking-tight leading-tight mb-8">
                أبحاثك الجامعية... <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">أكثر ذكاءً وسرعة</span>
            </h1>
            
            <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed mb-10">
                منصة "إنجاز" هي مساعدك الشخصي المدعوم بالذكاء الاصطناعي لكتابة وتنسيق مذكرات التخرج والبحوث الأكاديمية وفقاً لمعايير الجامعات الجزائرية.
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold text-lg hover:bg-blue-700 shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                    ابدأ بحثك الأول الآن
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
            </div>

            <!-- Dashboard Preview Image -->
            <div class="mt-20 relative max-w-5xl mx-auto">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-[2.5rem] blur opacity-20"></div>
                <div class="relative bg-white rounded-[2rem] border border-gray-200 shadow-2xl p-2 sm:p-4">
                    <div class="rounded-2xl overflow-hidden border border-gray-100 bg-gray-50 aspect-video flex items-center justify-center">
                        <!-- Abstract illustration of dashboard -->
                        <div class="w-full h-full p-8 flex flex-col gap-6">
                            <div class="h-12 w-full bg-white rounded-xl shadow-sm border border-gray-100 flex items-center px-6">
                                <div class="w-32 h-4 bg-gray-200 rounded-full"></div>
                                <div class="flex-grow"></div>
                                <div class="w-8 h-8 bg-blue-100 rounded-full"></div>
                            </div>
                            <div class="flex gap-6 flex-grow">
                                <div class="w-64 bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col gap-4 hidden md:flex">
                                    <div class="w-full h-8 bg-gray-100 rounded-lg"></div>
                                    <div class="w-3/4 h-4 bg-gray-100 rounded-lg"></div>
                                    <div class="w-5/6 h-4 bg-gray-100 rounded-lg"></div>
                                </div>
                                <div class="flex-grow bg-white rounded-xl shadow-sm border border-gray-100 p-8 flex flex-col gap-4">
                                    <div class="w-1/3 h-8 bg-gray-200 rounded-lg mb-4"></div>
                                    <div class="w-full h-4 bg-gray-100 rounded-lg"></div>
                                    <div class="w-full h-4 bg-gray-100 rounded-lg"></div>
                                    <div class="w-5/6 h-4 bg-gray-100 rounded-lg"></div>
                                    <div class="w-full h-4 bg-gray-100 rounded-lg mt-4"></div>
                                    <div class="w-4/5 h-4 bg-gray-100 rounded-lg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">كل ما تحتاجه للتميز الأكاديمي</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">أدوات متطورة مصممة خصيصاً لتلبية احتياجات الطالب الجامعي</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">توليد المحتوى بالذكاء الاصطناعي</h3>
                    <p class="text-gray-600 leading-relaxed">نقوم ببناء خطة البحث والمحتوى الأكاديمي بشكل دقيق وموثق باستخدام أحدث نماذج الذكاء الاصطناعي.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">تصدير PDF احترافي</h3>
                    <p class="text-gray-600 leading-relaxed">تصدير مذكرتك بضغطة زر بتنسيق مطابق للمعايير الأكاديمية الجزائرية مع واجهة رسمية جاهزة.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">إدارة المراجع الذكية</h3>
                    <p class="text-gray-600 leading-relaxed">نظام متكامل لإضافة وتنظيم المصادر والمراجع وربطها التلقائي بمحتوى البحث.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <span class="font-bold text-xl tracking-tight">إنجاز</span>
            </div>
            <p class="text-gray-400 text-sm">© {{ date('Y') }} تطوير OasisDev. جميع الحقوق محفوظة.</p>
        </div>
    </footer>
</body>
</html>