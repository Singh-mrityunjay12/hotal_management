<?php

use App\Models\SiteSetting;

/**
 * This File access anywhere in this project because this file autoload in with the help of composer dump-autoload this command
 * Set Sidebar item active
 */

function setActive(array $route)
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }

   
}

function getCurrencyIcon()
{
    $icon = SiteSetting::first();
    return $icon->currency_icon;
}
