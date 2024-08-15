<?php

namespace App\Helpers;

use Cron\HoursField;

/**
 * Format the time to the dashboard standard
 *
 * @param  integer  $milliseconds
 *
 * @return string the formatted time
 */
function dashboardTimeFormat(int $milliseconds): string
{
    $hours = (int) ($milliseconds / 3600000);
    $minutes = (int) ($milliseconds / 60000);
    $seconds = (int) ($milliseconds / 1000);

    if ($hours == 0 && $minutes == 0) return "{$seconds} second(s)";

    if ($hours == 0 && $minutes != 0) return "{$minutes} minute(s)";

    if($hours != 0) return "{$hours} hour(s)";
}

