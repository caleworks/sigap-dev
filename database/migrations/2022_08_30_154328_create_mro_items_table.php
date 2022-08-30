<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMroItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mro_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('unit_id')->references('id')->on('units');
            $table->string('mro_code')->unique();
            $table->string('mro_name');
            $table->integer('fix_stock')->default(0);
            $table->integer('max_stock')->default(0);
            $table->integer('stock')->default(0);
            $table->string('stored_at')->nullable();
            $table->string('notes')->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mro_items');
    }
}
