<?php

use \App\Models\Navigation;

if (!function_exists('getMenu')){
    function getMainMenu (){
        return Navigation::with('subMenus')->whereNull('main_menu')->get();
    }
}
