<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id');
            $table->string('key');
            $table->string('question');
            $table->string('description');
            $table->string('type');
            
            $table->foreign('form_id')->references('id')->on('forms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_attributes');
    }
};
