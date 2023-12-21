<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Menu;

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

        $menus = Menu::where('title', 'like', 'Bottom')->orderBy('id', 'ASC')->get();
        if($menus == null) {
            $menus = [];
        }

        $left_menus = Menu::where('title', 'like', 'Left Category Menu')->orderBy('id', 'ASC')->get();
        if($left_menus == null) {
            $left_menus = [];
        }
        

        \View::share('categoryData', $categoryData);
        \View::share('categoryDataArray', $categoryDataArray);
        \View::share('menuDataArray', $menus);
        \View::share('left_menus', $left_menus);


    }
}
