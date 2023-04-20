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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->float('stock_available', 8,0);
            $table->enum('movement',['issued','received','corrected']);
            $table->text('remark');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                    ->references('id')
                    ->on('items')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->unsignedBigInteger('sale_detail_id');
            $table->foreign('sale_detail_id')
                    ->references('id')
                    ->on('sale_details')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->unsignedBigInteger('purchase_detail_id');
            $table->foreign('purchase_detail_id')
                    ->references('id')
                    ->on('purchase_details')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->unsignedBigInteger('correction_id');
            $table->foreign('correction_id')
                    ->references('id')
                    ->on('corrections')
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
        Schema::dropIfExists('stocks');
    }
};
