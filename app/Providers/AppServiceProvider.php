<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\User;
use App\Branch;
use App\OptionValue;

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

        $size = OptionValue::where('option_id', 1)->get();
        View::share('sizes', $size);

        $color = OptionValue::where('option_id', 2)->get();
        View::share('colors', $color);
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
