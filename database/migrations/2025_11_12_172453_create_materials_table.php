<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->string('type'); // video, document, link, presentation
            $table->integer('lesson_number')->nullable();
            $table->json('links')->nullable(); // [{'label': 'Смотреть', 'url': '...', 'icon': '▶️'}]
            $table->boolean('is_new')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
