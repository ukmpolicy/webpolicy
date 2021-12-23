<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_picture')->nullable();
            $table->string('name');
            $table->string('nim');
            $table->string('address')->nullable();
            $table->string('birth_place')->nullable();
            $table->timestamp('born_at')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('major')->nullable();
            $table->string('interested_in')->nullable();
            $table->string('study_program')->nullable();
            $table->integer('joined_at')->nullable();
            $table->integer('status')->default(0); // 0: New Member | 1: Member | 2: Alumni
            $table->timestamp('store_document')->nullable();
            $table->timestamps();

            $table->foreign('profile_picture')->references('id')->on('sources');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
