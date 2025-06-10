<?php

namespace App\Traits;

trait ClearsHomepageCache
{
    public static function bootClearsHomepageCache()
    {
        static::saved(function () {
            static::clearHomepageCache();
        });

        static::deleted(function () {
            static::clearHomepageCache();
        });
    }

    public static function clearHomepageCache()
    {
        \Cache::forget('homepage_data_en');
        \Cache::forget('homepage_data_ro');
    }
}