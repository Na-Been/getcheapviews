<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\NewOrder;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


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
        View::composer('*', function ($view) {
            $setting = Setting::first();
            if ($setting != null) {
                $view->with('setting', $setting);
            } else {
                $view->with('setting', []);
            }

            $slider = Slider::first();
            if ($slider != null) {
                $view->with('slider', $slider);
            } else {
                $view->with('slider', []);
            }

            $category = Category::all();
            $view->with('categories',$category);

            $notification = NewOrder::where('mark_as_read',0)->latest()->get();
            $view->with('notifications',$notification);
        });
    }
}
