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
        Schema::create('events', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->text('description');

            $table->string('venue');

            $table->date('date');

            $table->time('time');

            $table->decimal('price', 8, 2);

            $table->string('image')->nullable();

            $table->string('payment_qr')->nullable();

            $table->foreignId('organizer_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
