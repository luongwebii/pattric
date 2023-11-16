<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBillingCountryToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            

            $table->string('billing_country')->nullable()->after('billing_city');
            $table->integer('shipping_quote')->nullable()->after('return_reason');
            $table->string('shipping_package')->nullable()->after('shipping_quote');

            $table->string('card_month')->nullable()->after('card_expired');
            $table->string('card_year')->nullable()->after('card_month');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('billing_country');
            $table->dropColumn('shipping_quote');
            $table->dropColumn('shipping_package');

            $table->dropColumn('card_month');
            $table->dropColumn('card_year');
        });
    }
}
