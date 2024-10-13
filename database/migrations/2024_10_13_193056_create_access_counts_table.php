<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessCountsTable extends Migration
{
    public function up()
    {
        Schema::create('access_counts', function (Blueprint $table) {
            $table->id();
            $table->string('countable_type');
            $table->unsignedBigInteger('countable_id');
            $table->string('marker_type');
            $table->unsignedBigInteger('total_count')->default(0);
            $table->timestamps();

            $table->index(['countable_type', 'countable_id', 'marker_type'], 'access_counts_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('access_counts');
    }
}
