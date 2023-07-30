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
        Schema::table('history_dignosa', function (Blueprint $table) {
            $table->string('alamat');
            $table->string('persentase');
            $table->string('solusi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_dignosa', function (Blueprint $table) {
            $table->dropColumn('alamat');
            $table->dropColumn('persentase');
            $table->dropColumn('solusi');
        });
    }
};
