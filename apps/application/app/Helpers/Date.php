<?php

namespace App\Helpers;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Exception;

class Date
{
    public static function dateObject(Carbon|string $date = null, bool $force_utc = true)
    {
        try {
            throw_if(! $date, 'no-time');

            if (is_string($date)) {
                $date = new Carbon($date);
            }

            if ($force_utc) {
                $date->setTimezone('UTC');
            }

            return [
                'date'       => optional($date)->format(config('app.database-date-format')),
                'datetime'   => optional($date)->format(config('app.database-datetime-format')),
                'for_human'  => optional($date)->diffForHumans(),
                'is_utc'     => $date->isUtc(),
                'time'       => optional($date)->format(config('app.database-datetime-format')),
                'timezone'   => $date->timezone,
                'type'       => 'date',
                'utc_offset' => $date->utcOffset(),
                'valid'      => true,
                'is_dirty'   => false,
            ];
        } catch (Exception $exception) {
            return [
                'date'       => '',
                'datetime'   => '',
                'for_human'  => '',
                'is_utc'     => false,
                'time'       => '',
                'timezone'   => '',
                'type'       => 'date',
                'utc_offset' => new CarbonTimeZone(
                    timezone: 'UTC',
                ),
                'valid'    => false,
                'is_dirty' => false,
            ];
        }
    }
}
