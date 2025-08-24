<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('consents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('session_id', 100)->nullable()->index();
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();

            // Préférences par catégorie
            $table->boolean('functional')->default(true);   // nécessaires → toujours true
            $table->boolean('analytics')->default(false);
            $table->boolean('marketing')->default(false);

            $table->json('raw_payload')->nullable();         // optionnel : garder le détail exact envoyé
            $table->timestamp('consented_at')->nullable();   // date du consentement
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consents');
    }
};
