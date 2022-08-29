<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyActiveToCompanyAccesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_accesses', function (Blueprint $table) {
            $table->boolean('active')->nullable()->default(false)->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_accesses', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
}
