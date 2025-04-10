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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Chủ nhà hàng
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('image');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
