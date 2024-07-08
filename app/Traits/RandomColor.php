<?php

namespace App\Traits;

trait RandomColor
{
    public static function getRandomColorBasedOnPrimary()
    {
        $baseColor = [0, 50, 115];

        $red = $baseColor[0] + rand(-20, 225);
        $green = $baseColor[1] + rand(-20, 225);
        $blue = $baseColor[2] + rand(-20, 225);

        $red = max(0, min(255, $red));
        $green = max(0, min(255, $green));
        $blue = max(0, min(255, $blue));

        return sprintf('#%02x%02x%02x', $red, $green, $blue);
    }
}
