<?php
namespace CisFoundation\CisTableBuilder;

use CisFoundation\CisTableBuilder\Component\CisTableComponent;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class CisTableServiceProvider extends ServiceProvider {

    public function register() {
        //
    }

    public function boot() {
        $this->loadViewsFrom(__DIR__.'/resources/views','cis-table-builder');
        Blade::component(CisTableComponent::class,'cis-table');
    }
}
