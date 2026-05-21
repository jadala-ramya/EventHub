<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {

            // EVENT TYPE
            if (!Schema::hasColumn('events', 'event_type'))
            {
                $table->string('event_type')
                      ->default('standing');
            }

            // TOTAL SEATS
            if (!Schema::hasColumn('events', 'total_seats'))
            {
                $table->integer('total_seats')
                      ->nullable();
            }

            // REMAINING SEATS
            if (!Schema::hasColumn('events', 'remaining_seats'))
            {
                $table->integer('remaining_seats')
                      ->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {

            $table->dropColumn([
                'event_type',
                'total_seats',
                'remaining_seats'
            ]);

        });
    }
};
