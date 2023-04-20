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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')
                    ->references('id')
                    ->on('purchases')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->unsignedBigInteger('order_detail_id');
            $table->foreign('order_detail_id')
                    ->references('id')
                    ->on('order_details')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->enum('status',['new','received','confirmed','cancelled','partial'])->default('new');
            $table->float('quantity_approved',8,0);
            $table->float('quantity_balance',8,0);
            $table->float('quantity_served',8,0);
            $table->float('price',8,2);
            $table->float('amount_approved',8,2);
            $table->text('remark')->default('n/a');
            $table->unsignedBigInteger('received_by');
            $table->foreign('received_by')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->unsignedBigInteger('confirmed_by');
            $table->foreign('confirmed_by')
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
        Schema::dropIfExists('purchase_details');
    }
};
