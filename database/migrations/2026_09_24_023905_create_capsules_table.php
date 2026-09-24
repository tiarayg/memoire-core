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
        Schema::create('capsules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('type', [
                'time',
                'secret',
                'open_when',
            ]);

            $table->string('title', 150);
            $table->longText('content');

            $table->enum('status', [
                'draft',
                'sealed',
                'ready',
                'opened',
            ]);

            $table->dateTime('open_at')->nullable();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('open_when_categories')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capsules');
    }
};
