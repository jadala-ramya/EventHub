<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizerRequestsTable extends Migration
{
    public function up(): void
    {
        Schema::create('organizer_requests', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('full_name');

            $table->string('phone');

            $table->string('organization_name');

            $table->text('event_details');

            $table->string('id_proof');

            $table->string('status')
                  ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizer_requests');
    }
}
