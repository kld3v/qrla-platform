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
            $table->dropForeign(['base_url_id']);
            $table->dropColumn('base_url_id');
            $table->foreignId('redirect_id')->constrained()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropForeign(['redirect_id']);
            $table->dropColumn('redirect_id');
            $table->foreignId('base_url_id')->constrained()->nullable();
        });
    }
};

};
