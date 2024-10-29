<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->foreignId('redirect_id')->constrained()->nullable();
            $table->dropColumn('base_url_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->foreignId('base_url_id')->constrained()->nullable();
            $table->dropColumn('redirect_id');
        });
    }
};
