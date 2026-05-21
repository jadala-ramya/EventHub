<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {

            if (!Schema::hasColumn('events', 'status')) {
                $table->string('status')
                      ->default('active');
            }

            if (!Schema::hasColumn('events', 'event_type')) {
                $table->string('event_type')
                      ->default('standing');
            }

            if (!Schema::hasColumn('events', 'total_seats')) {
                $table->integer('total_seats')
                      ->nullable();
            }

            if (!Schema::hasColumn('events', 'remaining_seats')) {
                $table->integer('remaining_seats')
                      ->nullable();
            }

        });
    }

    public function down(): void
    {
        // optional rollback
    }
};
