<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tv_show_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tv_show_id')
                ->constrained('tv_shows')
                ->onDelete('cascade');

            // 0–6 (e.g. 0=Sunday, 1=Monday, ... 6=Saturday)
            $table->unsignedTinyInteger('day_of_week');

            // Airing time, e.g. 20:30:00 for 8:30 PM
            $table->time('start_time');

            $table->timestamps();

            $table->index(['tv_show_id', 'day_of_week', 'start_time'], 'tv_show_schedule_show_day_time_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tv_show_schedules');
    }
};
