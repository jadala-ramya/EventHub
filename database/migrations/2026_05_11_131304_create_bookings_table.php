<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('event_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('payment_screenshot')->nullable();

            $table->string('ticket_number')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
