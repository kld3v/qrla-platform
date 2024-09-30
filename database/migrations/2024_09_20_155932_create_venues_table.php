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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address_line1');  // First line of address
            $table->string('city');
            $table->string('country');
            $table->string('postcode');
            $table->enum('type', ['Sport', 'Concert Hall', 'Theatre', 'Confex']);
            $table->string('logo_url')->nullable();
            $table->string('banner_url')->nullable();
            $table->integer('capacity');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('management')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
