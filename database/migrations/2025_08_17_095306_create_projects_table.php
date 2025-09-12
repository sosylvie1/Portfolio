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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique(); // URL propre
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->json('tech')->nullable();
        $table->string('github')->nullable();
        $table->string('live')->nullable();
        $table->string('case')->nullable();
        $table->string('readme')->nullable();
        $table->string('video')->nullable();
        $table->string('video_webm')->nullable();
        $table->string('figma')->nullable();
        $table->json('figma_images')->default(json_encode([]));
        $table->date('date')->nullable();
        $table->boolean('is_published')->default(true); // afficher/masquer
        $table->integer('order')->default(0);           // tri manuel
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
