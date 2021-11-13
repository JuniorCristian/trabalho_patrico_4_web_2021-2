<?php

use Collective\Html\FormFacade;
use Illuminate\Support\Facades\Route;

if(!function_exists('form')){
    function form()
    {
        return FormFacade::getFacadeRoot();
    }
}

if(!function_exists('route_name')){
    function route_name(): ?string
    {
        return Route::currentRouteName();
    }
}

if(!function_exists('term_now')){
    function term_now(): string
    {
        return date('Y').'-'.(date('m')<7?'01':'02');
    }
}
