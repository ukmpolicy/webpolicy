<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropForeign(['profile_picture']);
            $table->dropColumn('profile_picture');
            $table->dropColumn('interested_in');
            $table->dropColumn('status');
            $table->dropColumn('store_document');

            $table->string('photo');
            $table->string('born_at')->change();
            $table->integer('graduation_at')->nullable();
            $table->json('other_detail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
        });
    }
}
