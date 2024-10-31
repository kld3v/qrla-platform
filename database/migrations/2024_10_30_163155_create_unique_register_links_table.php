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
        Schema::create('unique_register_links', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->string('role');
            $table->unsignedBigInteger('organisation_id');
            $table->json('venue_ids')->nullable();
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unique_register_links');
    }
};
