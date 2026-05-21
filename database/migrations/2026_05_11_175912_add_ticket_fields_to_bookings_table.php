<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            $table->string('ticket_id')
                  ->nullable();

            $table->string('qr_code')
                  ->nullable();

        });
    }

    /**
     * Reverse migrations
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            $table->dropColumn('ticket_id');

            $table->dropColumn('qr_code');

        });
    }
};
