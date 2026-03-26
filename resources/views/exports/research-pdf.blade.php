<!DOCTYPE html>
<html lang="{{ $research->language }}" dir="{{ $research->language === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 2.5cm; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            color: #1a202c;
        }
        .cover-page {
            text-align: center;
            height: 90vh; /* Use vh for better PDF generator compatibility */
            border: 2px solid #2d3748;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }
        .ministry { font-weight: bold; font-size: 14px; margin-bottom: 5px; }
        .university-info { margin-top: 10px; font-weight: bold; }
        .research-title { margin-top: 0; font-size: 28px; font-weight: bold; color: #2b6cb0; border-bottom: 3px solid #2b6cb0; display: inline-block; padding-bottom: 10px; }
        .subject-info { margin-top: 20px; font-size: 18px; color: #4a5568; }
        .student-teacher { margin-top: 0; width: 100%; }
        .student-teacher td { vertical-align: top; width: 50%; padding: 10px; }
        .year { margin-top: 0; font-weight: bold; }
        
        .section-page { page-break-before: always; }
        .section-title { font-size: 22px; font-weight: bold; color: #2c5282; border-bottom: 1px solid #e2e8f0; margin-bottom: 20px; padding-bottom: 5px; }
        .content { font-size: 14px; white-space: pre-wrap; }
        .reference-item-ar {
            margin-bottom: 10px;
            border-right: 3px solid #cbd5e0;
            padding-right: 10px;
        }
        .reference-item-ltr {
            margin-bottom: 10px;
            border-left: 3px solid #cbd5e0;
            padding-left: 10px;
        }
    </style>
</head>
<body @style([
    'direction: ' . ($research->language === 'ar' ? 'rtl' : 'ltr'),
    'text-align: ' . ($research->language === 'ar' ? 'right' : 'left'),
])>
    {{-- Cover Page --}}
    <div class="cover-page">
        <div class="ministry">الجمهورية الجزائرية الديمقراطية الشعبية</div>
        <div class="ministry">وزارة التعليم العالي والبحث العلمي</div>
        
        <div class="university-info">
            <div>{{ $research->university }}</div>
            <div>{{ $research->faculty }}</div>
        </div>

        <div class="research-title">{{ $research->title }}</div>
        <div class="subject-info">مذكرة مقدمة لنيل شهادة الليسانس / الماستر في: {{ $research->subject }}</div>

        <table class="student-teacher">
            <tr>
                <td>
                    <strong>إعداد الطالب(ة):</strong><br>
                    {{ $research->student_name }}
                </td>
                <td>
                    <strong>تحت إشراف الأستاذ(ة):</strong><br>
                    {{ $research->teacher_name }}
                </td>
            </tr>
        </table>

        <div class="year">السنة الجامعية: 2025 / 2026</div>
    </div>

    {{-- Sections --}}
    @foreach($research->sections as $section)
        <div class="section-page">
            <h2 class="section-title">{{ $section->title }}</h2>
            <div class="content">
                {!! $section->content !!}
            </div>
        </div>
    @endforeach

    {{-- References Page --}}
    @if($research->references->count() > 0)
        <div class="section-page">
            <h2 class="section-title">قائمة المراجع والمصادر</h2>
            <div class="content">
                @foreach($research->references as $ref)
                    <div class="{{ $research->language === 'ar' ? 'reference-item-ar' : 'reference-item-ltr' }}">
                        <strong>{{ $ref->author }} ({{ $ref->year }})</strong>: {{ $ref->title }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</body>
</html>
