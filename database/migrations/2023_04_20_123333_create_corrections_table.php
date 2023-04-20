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
        Schema::create('corrections', function (Blueprint $table) {
            $table->id();
            $table->float('quantity_previous',8,0);
            $table->float('quantity_new',8,0);
            $table->float('quantity_difference',8,0);
            $table->enum('variance',['positive','negative']);
            $table->enum('status',['pending','approved']);
            $table->text('remark');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                    ->references('id')
                    ->on('items')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->unsignedBigInteger('approver_id');
            $table->foreign('approver_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')
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
        Schema::dropIfExists('corrections');
    }
};
