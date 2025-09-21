<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('voyage_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voyage_id')->constrained()->onDelete('cascade');
            $table->string('src');       // chemin de la photo
            $table->text('caption')->nullable(); // description de la photo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voyage_photos');
    }
};

