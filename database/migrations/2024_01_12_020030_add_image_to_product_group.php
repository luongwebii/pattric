<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToProductGroup extends Migration
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
            $table->boolean('man_way_flag')->default(false)->after('racking_flag');
            $table->boolean('capacity_flag')->default(false)->after('man_way_flag');
            $table->boolean('image_flag')->default(false)->after('capacity_flag');
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
            $table->dropColumn('man_way_flag');
            $table->dropColumn('capacity_flag');
            $table->dropColumn('image_flag');
        });
    }
}
