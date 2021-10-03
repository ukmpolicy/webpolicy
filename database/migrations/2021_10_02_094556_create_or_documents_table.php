<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('or_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable();
            $table->foreignId('certificate')->nullable();
            $table->foreignId('proof_pkkmb')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')->nullOnDelete();
            $table->foreign('certificate')->references('id')->on('sources')->nullOnDelete();
            $table->foreign('proof_pkkmb')->references('id')->on('sources')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('or_documents');
    }
}
