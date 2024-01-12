<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlagToProductGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_group', function (Blueprint $table) {
            //
            $table->boolean('size_flag')->default(false)->after('description');
            $table->boolean('drawing_flag')->default(false)->after('size_flag');
            $table->boolean('orient_flag')->default(false)->after('drawing_flag');
            $table->boolean('area_sm_flag')->default(false)->after('orient_flag');
            $table->boolean('bottom_flag')->default(false)->after('description');
            $table->boolean('racking_flag')->default(false)->after('bottom_flag');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_group', function (Blueprint $table) {
            //
            $table->dropColumn('sale_price');
            $table->dropColumn('drawing_flag');
            $table->dropColumn('orient_flag');
            $table->dropColumn('area_sm_flag');
            $table->dropColumn('bottom_flag');
            $table->dropColumn('racking_flag');
        });
    }
}
