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
    Schema::create('voyages', function (Blueprint $table) {
        $table->id();
        $table->string('pays');          // Pays ou lieu
        $table->string('annee');         // Année du voyage
        $table->string('photo')->nullable();  // Une seule photo
        $table->text('description')->nullable(); // Texte descriptif
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
