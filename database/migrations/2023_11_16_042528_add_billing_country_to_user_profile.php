<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBillingCountryToUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            //
            $table->string('billing_first_name')->nullable()->after('shipping_instructions');
            $table->string('billing_last_name')->nullable()->after('billing_first_name');
            $table->string('billing_email')->nullable()->after('billing_last_name');
            $table->string('billing_phone')->nullable()->after('billing_email');
            $table->string('billing_country')->nullable()->after('billing_city');
            $table->string('shipping_quote')->nullable()->after('shipping_instructions');
            $table->string('shipping_package')->nullable()->after('shipping_quote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            //
            $table->dropColumn('billing_first_name');
            $table->dropColumn('billing_last_name');
            $table->dropColumn('billing_email');
            $table->dropColumn('billing_phone');
            $table->dropColumn('billing_country');
            $table->dropColumn('shipping_quote');
            $table->dropColumn('shipping_package');
        });
    }
}
