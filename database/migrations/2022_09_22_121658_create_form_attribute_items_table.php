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
        Schema::create('form_attribute_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_attribute_id');
            $table->string('name');

            $table->foreign('form_attribute_id')->references('id')->on('form_attributes');
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
        Schema::dropIfExists('form_attribute_items');
    }
};
