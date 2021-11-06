<?php
if(!function_exists('form')){
    function form()
    {
        return \Collective\Html\FormFacade::getFacadeRoot();
    }
}

if(!function_exists('route_name')){
    function route_name(): ?string
    {
        return \Illuminate\Support\Facades\Route::currentRouteName();
    }
}
