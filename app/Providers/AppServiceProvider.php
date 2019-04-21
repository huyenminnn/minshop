<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\User;
use App\Branch;
use App\OptionValue;
use App\Role;
use App\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //view share
        $category = Category::where('parent_id', 0)->get();
        View::share('category_parent', $category);

        $categories = Category::get();
        View::share('categories', $categories);
        
        $managers = User::get();
        View::share('managers', $managers);

        $branches = Branch::get();
        View::share('branches', $branches);

        $sizes = OptionValue::where('option_id', 1)->get();
        View::share('sizes', $sizes);

        $color = OptionValue::where('option_id', 2)->get();
        View::share('colors', $color);

        $role = Role::get();
        View::share('roles', $role);

        $products = Product::orderBy('id', 'desc')->take(8)->get();
        View::share('products', $products);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
