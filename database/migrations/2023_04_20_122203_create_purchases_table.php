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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->string('po_number')->nullable();
            $table->float('amount_total',10,2)->nullable();
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')
                    ->references('id')
                    ->on('suppliers')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->enum('status',['new','processing','cancelled','closed'])->default('new');
            $table->date('date');
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
        Schema::dropIfExists('purchases');
    }
};
