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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->tinyInteger('withdrawalStatus');
            $table->string('userName');
            $table->double('amount');
            $table->string('address')->nullable();
            $table->timestamp('datePaid')->nullable();
            $table->string('bankName');
            $table->string('bankAccountName');
            $table->string('bankAccountNumber');
            $table->string('withdrawTo');
            $table->string('wallet');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
