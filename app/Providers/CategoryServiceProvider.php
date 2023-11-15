<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $categoryData = Category::orderBy('category_name_en', 'ASC')->get();
        $categoryDataArray = [];
        foreach( $categoryData as $key => $value ) {
            $categoryDataArray[$value->id] = $value->category_name_en;
        }

        \View::share('categoryData', $categoryData);
        \View::share('categoryDataArray', $categoryDataArray);


    }
}
