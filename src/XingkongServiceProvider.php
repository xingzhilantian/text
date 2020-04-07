<?php

namespace xingkong\composertest;

use Illuminate\Support\ServiceProvider;

class XingkongServiceProvider extends ServiceProvider
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
        // 移动config配置文件
        $this->publishes([
            __DIR__.'/../config/xingkong.php' => config_path('xingkong.php'),
        ]);
    }
}
