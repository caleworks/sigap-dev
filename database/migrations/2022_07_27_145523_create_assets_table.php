<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_spec_id');
            $table->foreignId('user_id_purchaser');
            $table->foreignId('user_id_deliver')->nullable();
            $table->date('date_purchase');
            $table->date('date_deliver')->nullable();
            $table->string('product_code');
            $table->string('employee_user')->nullable();
            $table->string('location');
            $table->string('notes')->nullable();
            $table->string('serial_number');
            $table->string('regist_number');
            $table->string('qr_code')->nullable();
            $table->string('scan_bast')->nullable();
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
        Schema::dropIfExists('assets');
    }
}
