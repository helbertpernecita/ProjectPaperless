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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')
                    ->references('id')
                    ->on('positions')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')
                    ->references('id')
                    ->on('positions')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('position_id');
            $table->dropForeign('position_id');
            $table->dropColumn('department_id');
            $table->dropForeign('department_id');
        });
    }
};
