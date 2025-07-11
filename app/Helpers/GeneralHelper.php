<?php

use App\Models\Setting;

if(!function_exists('generateRandomId')){
    function generateRandomId($prefix = "SP", $lenght = 6)
    {
        return $prefix . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $lenght);
    }
}

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return cache()->remember("setting_{$key}", 60, function () use ($key, $default) {
            return Setting::where('key', $key)->value('value') ?? $default;
        });
    }

    function setting_set($key, $value)
    {
        Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        cache()->forget("setting_{$key}");
    }
}
