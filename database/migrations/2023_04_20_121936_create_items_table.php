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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->string('image_item')->nullable();
            $table->text('remark')->dafault('n/a');
            $table->float('purchase_price',8,2);
            $table->float('selling_price',8,2);
            $table->integer('active')->default(1);
            $table->float('stock_minimum',8,2);
            $table->float('stock_available',8,2);
            $table->enum('sfn', ['fast moving','slow moving','non-moving'])->default('fast moving');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')
                    ->references('id')
                    ->on('units')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
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
        Schema::dropIfExists('items');
    }
};
