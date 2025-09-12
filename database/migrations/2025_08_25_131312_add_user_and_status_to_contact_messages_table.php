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
        Schema::table('contact_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_messages', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->onDelete('cascade');
            }

            if (!Schema::hasColumn('contact_messages', 'status')) {
                $table->string('status')->default('sent');
                // valeurs possibles : sent, received, deleted
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            // ⚠️ SQLite ne supporte pas dropForeign() → on supprime directement la colonne
            if (Schema::hasColumn('contact_messages', 'user_id')) {
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('contact_messages', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};

