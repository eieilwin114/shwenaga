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
        Schema::create('monthly_performances', function (Blueprint $table) {
            $table->id();
            $table->date('month');
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('employee_id');
            $table->integer('mark1');
            $table->integer('mark2');
            $table->integer('mark3');
            $table->integer('mark4');
            $table->integer('mark5');
            $table->integer('total');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('update_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_performance');
    }
};
