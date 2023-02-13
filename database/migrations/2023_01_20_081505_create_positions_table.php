<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->constrained('periods');
            $table->foreignId('division_id')->nullable();
            $table->string('name');
            $table->integer('index')->nullable();
            $table->foreignId('sub_in_position_id')->nullable();
            $table->timestamps();

            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('sub_in_position_id')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
