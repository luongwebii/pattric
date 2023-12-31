<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->string('product_name_en');
            $table->string('product_slug_en');
            $table->string('model')->nullable();
            $table->string('price')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('drawing')->nullable();
            $table->string('orient')->nullable();
            $table->string('area_sm')->nullable();
            $table->string('bottom_butter')->nullable();
            $table->string('racking_butter')->nullable();
            $table->string('man_way')->nullable();
            $table->string('capacity')->nullable();
          
            $table->string('product_tags_en')->nullable();
            $table->string('size')->nullable();
            $table->string('product_color')->nullable();
            $table->string('discount')->nullable();
            $table->string('short_description_en')->nullable();

            $table->longText('long_description_en');

            $table->string('image')->nullable();
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->boolean('status')->default(true);
            $table->text('meta_keywords_en')->nullable();

            $table->text('meta_description_en')->nullable();

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
        Schema::dropIfExists('products');
    }
}
