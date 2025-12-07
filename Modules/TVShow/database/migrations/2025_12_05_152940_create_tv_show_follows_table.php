<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tv_show_follows', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('tv_show_id')
                ->constrained('tv_shows')
                ->onDelete('cascade');

            $table->timestamps();

            // Each user can follow a given show only once
            $table->unique(['user_id', 'tv_show_id'], 'tv_show_follows_user_show_unique');
            $table->index('tv_show_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tv_show_follows');
    }
};
