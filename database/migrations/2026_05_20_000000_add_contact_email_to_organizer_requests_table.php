<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organizer_requests', function (Blueprint $table) {
            $table->string('contact_email')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('organizer_requests', function (Blueprint $table) {
            $table->dropColumn('contact_email');
        });
    }
};
