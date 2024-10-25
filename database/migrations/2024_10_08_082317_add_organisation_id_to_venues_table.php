<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('venues', function (Blueprint $table) {
            $table->dropColumn('management');
            $table->foreignId('organisation_id')->nullable()->constrained('organisations')->cascadeOnDelete()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('venues', function (Blueprint $table) {
            $table->string('management')->nullable();

            $table->dropForeign(['organisation_id']);
            $table->dropColumn('organisation_id');
        });
    }
};
