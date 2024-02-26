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
        Schema::create('admins', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('firstName');
            $table->string('lastName');                        
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->string('country');
            $table->string('phoneNumber');
            $table->string('totalBalance');
            $table->string('roles');
            $table->string('type');
            $table->string('userName', 20)->unique();
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
