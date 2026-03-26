<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('researches', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('university')->default('جامعة الأغواط');
            $table->string('faculty');
            $table->string('subject'); // المقياس
            $table->string('student_name');
            $table->string('teacher_name');
            $table->enum('language', ['ar', 'fr', 'en'])->default('ar');
            $table->longText('content')->nullable(); // محتوى البحث الذكي
            $table->json('plan')->nullable(); // خطة البحث كـ JSON
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('researches'); }
};
