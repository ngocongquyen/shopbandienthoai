<?php

namespace App\Providers;
use App\Models\Product;
use App\Models\Post;
use App\Models\Customer;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Admin;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('*',function($view) {
            $p_product=Product::all()->count();
            $b_brand=Brand::all()->count();
            $o_order=Order::all()->count();
            $p_post=Post::all()->count();
            $c_customer=Customer::all()->count();
            $a_admin=Admin::all()->count();
            $view->with(compact('p_product','b_brand','o_order','p_post','c_customer','a_admin'));
        });
       
    }
}
