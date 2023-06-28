<?php
namespace App\Facades\TablerExtension;
use Illuminate\Support\Facades\Facade;
class TablerExtensionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tablerextension';
        return 'device.tablerextension';
        return 'markdown.tablerextension';
        return 'screentesting.tablerextension';
        return 'toc.tablerextension';
        return 'uatsheet.tablerextension';
        return 'unittesting.tablerextension';
    }
}