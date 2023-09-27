<?php

use App\Models\Setting;

if (!function_exists('Setting')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function Setting($name, $default = null)
    {
        return Setting::getByName($name, $default);
    }
}
