<?php
if(!function_exists('form')){
    function form(){
        return \Collective\Html\FormFacade::getFacadeRoot();
    }
}
