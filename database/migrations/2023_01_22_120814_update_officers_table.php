<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('officers', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
            $table->dropColumn('role'); // 0: Ketua | 1: Sekretaris | 2: Bendahara | 3: Anggota
            $table->dropColumn('period_start_at');
            $table->dropColumn('period_end_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('officers', function (Blueprint $table) {
            //
        });
    }
}
