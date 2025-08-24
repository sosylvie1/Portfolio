<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'cookie_consent_status',
                'cookie_consent_at',
                'cookie_consent_ip',
                'cookie_consent_user_agent',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cookie_consent_status')->nullable(); // 'accepted' | 'refused'
            $table->timestamp('cookie_consent_at')->nullable();
            $table->string('cookie_consent_ip', 45)->nullable();
            $table->text('cookie_consent_user_agent')->nullable();
        });
    }
};

