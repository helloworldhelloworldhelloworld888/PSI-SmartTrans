<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AnalisisSetting extends Settings
{
    public string $defaultDataSet;

    public static function group(): string
    {
        return 'analisis';
    }
}
