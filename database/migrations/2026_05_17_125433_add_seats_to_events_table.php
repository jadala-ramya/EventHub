<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {

            if (!Schema::hasColumn('events', 'total_seats')) {
                $table->integer('total_seats')->default(0);
            }

            if (!Schema::hasColumn('events', 'available_seats')) {
                $table->integer('available_seats')->default(0);
            }

            if (!Schema::hasColumn('events', 'status')) {
                $table->string('status')->default('open');
            }

            if (!Schema::hasColumn('events', 'entry_code')) {
                $table->string('entry_code')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {

            if (Schema::hasColumn('events', 'total_seats')) {
                $table->dropColumn('total_seats');
            }

            if (Schema::hasColumn('events', 'available_seats')) {
                $table->dropColumn('available_seats');
            }

            if (Schema::hasColumn('events', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('events', 'entry_code')) {
                $table->dropColumn('entry_code');
            }

        });
    }
};
