<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('author'); // المؤلف
            $table->string('title'); // عنوان الكتاب
            $table->string('material_type'); // نوعية المادة
            $table->string('publishing_place')->nullable(); // مكان النشر
            $table->string('publisher')->nullable(); // الناشر
            $table->date('publish_date')->nullable(); // تاريخ النشر
            $table->integer('parts')->nullable(); // الأجزاء
            $table->integer('ratio_count')->nullable(); // عدد النسبة
            $table->boolean('is_available')->default(true); // Borrow status
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
