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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->date('date');
            $table->enum('status',['new','processing','closed'])->default('new');
            $table->text('remark')->default('n/a');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
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
        Schema::dropIfExists('orders');
    }
};
