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
        Schema::create('secret_capsules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('capsule_id')
                ->unique()
                ->constrained('capsules')
                ->cascadeOnDelete();

            $table->foreignId('recipient_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('recipient_email')->nullable();

            $table->string('password_hash');

            $table->string('hint')->nullable();

            $table->string('share_token')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secret_capsules');
    }
};