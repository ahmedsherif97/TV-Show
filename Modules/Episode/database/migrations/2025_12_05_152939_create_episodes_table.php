<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tv_show_id')
                ->constrained('tv_shows')
                ->onDelete('cascade');

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('duration_seconds')->default(0);
            $table->dateTime('airing_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('tv_show_id');
            $table->index('airing_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
