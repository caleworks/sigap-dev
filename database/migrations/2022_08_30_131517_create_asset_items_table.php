<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->references('id')->on('assets');
            $table->string('asset_code');
            $table->string('serial_number')->unique();
            $table->string('regist_number')->nullable()->unique();
            $table->string('status')->default('ready');
            $table->string('deliver_to')->nullable();
            $table->string('location')->nullable();
            $table->date('date_purchase')->nullable();
            $table->date('date_deliver')->nullable();
            $table->string('scan_bast')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('asset_items');
    }
}
