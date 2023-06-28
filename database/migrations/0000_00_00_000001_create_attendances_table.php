<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');

            $table->time('check_in_at', $precision = 0);
            $table->json('check_in_position');

            $table->time('check_out_at', $precision = 0);
            $table->json('check_out_position');
            
            $table->integer('employee_id');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('attendances');
    }
}
