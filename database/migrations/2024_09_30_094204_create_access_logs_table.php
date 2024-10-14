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
        Schema::create('access_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marker_id');
            $table->ipAddress('ip_address');
            $table->string('user_agent');
            $table->string('os')->nullable();
            $table->string('device')->nullable();
            $table->string('country')->nullable();
            $table->string('browser')->nullable();
            $table->string('language')->nullable();
            $table->string('referrer')->nullable();
            $table->timestamp('accessed_at');
            $table->timestamps();

            $table->foreign('marker_id')->references('id')->on('markers');
            $table->index(['marker_id', 'accessed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_logs');
    }
};
