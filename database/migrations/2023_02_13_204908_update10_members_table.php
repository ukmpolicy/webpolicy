<?php

use App\Models\Member;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update10MembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->integer('date_of_birth');
        });

        foreach (Member::all() as $member) {
            $member = Member::find($member->id);
            $member->date_of_birth = strtotime($member->born_at);
            $member->save();
        }
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('born_at');
        });
        Schema::table('members', function (Blueprint $table) {
            $table->integer('born_at');
        });
        foreach (Member::all() as $member) {
            $member = Member::find($member->id);
            $member->born_at = $member->date_of_birth;
            $member->save();
        }
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('date_of_birth');
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
