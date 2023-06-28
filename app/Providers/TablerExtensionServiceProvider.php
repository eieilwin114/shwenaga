<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\TablerExtension\TablerExtension;
class TablerExtensionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('tablerextension',function(){
            return new TablerExtension();
        });

        $this->app->bind('device.tablerextension',function(){
            return new DeviceTablerExtension();
        });
        $this->app->bind('markdown.tablerextension',function(){
            return new MarkdownTablerExtension();
        });
        $this->app->bind('screentesting.tablerextension',function(){
            return new ScreenTestingTablerExtension();
        });
        $this->app->bind('toc.tablerextension',function(){
            return new TocTestingTablerExtension();
        });
        $this->app->bind('uatsheet.tablerextension',function(){
            return new UatSheetTablerExtension();
        });
        $this->app->bind('unittesting.tablerextension',function(){
            return new UnitTestingTablerExtension();
        });


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
