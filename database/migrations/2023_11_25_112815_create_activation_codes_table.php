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
        Schema::create('activation_codes', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->double('activationCode')->unique();
            $table->integer('plan');
            $table->string('status');
            $table->string('purchasedUser')->nullable();
            $table->string('activatedUser')->nullable();
            $table->timestamp('dateUsed')->nullable();
            $table->timestamp('datePurchased')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activation_codes');
    }
};
