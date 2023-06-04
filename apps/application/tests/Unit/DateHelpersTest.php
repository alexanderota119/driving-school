<?php

use App\Helpers\Date as DateHelper;
use App\Models\Tenant;
use App\Models\TimeOff;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('App\Helpers\Date::dateObject valid', function ($data) {
    $test_date = new Carbon($data);
    $date_object = DateHelper::dateObject($test_date);

    expect($date_object)->toBeArray();
    expect($date_object)->toMatchArray([
        'timezone' => new CarbonTimeZone(
            timezone: 'UTC',
        ),
        'utc_offset' => 0,
        'is_utc'     => true,
        'date'       => date('m/d/Y', strtotime($test_date)),
        'time'       => date('g:i A', strtotime($test_date)),
        'datetime'   => date('m/d/Y g:i A', strtotime($test_date)),
        'for_human'  => $test_date->diffForHumans(),
        'valid'      => true,
    ]);
})->with([
    '2022-09-08',
    '2022-09-08 08:33',
]);

test('App\Helpers\Date::dateObject invalid', function ($test_date) {
    $date_object = DateHelper::dateObject($test_date);

    expect($date_object)->toBeArray();
    expect($date_object)->toHaveKey('valid');
    expect($date_object['valid'])->toEqual(false);
})->with([
    '2022-0s9-08',
    '2022-09-08 0s8:33',
]);

test('Make sure the application is storing UTC times', function ($date) {
    $test_date = Carbon::create(
        year: $date['year'],
        month: $date['month'],
        day: $date['day'],
        hour: $date['hour'],
        minute: $date['minute'],
        second: $date['second'],
        tz: $date['tz'],
    );

    $time_off_data = [
        'date_time_off' => $test_date,
        'time_start'    => $test_date,
    ];

    $this->seed(DatabaseSeeder::class);

    $new_tenant = 'Test Tenant';
    $slug = Str::slug($new_tenant);

    $tenant = Tenant::create([
        'id'   => $slug,
        'name' => $new_tenant,
    ]);

    $timeoff_record = $tenant->run(fn () => TimeOff::factory()->create($time_off_data));

    $date_object = DateHelper::dateObject($test_date);

    expect($date_object)->toMatchArray([
        'valid'    => true,
        'timezone' => new CarbonTimeZone(
            timezone: 'UTC',
        ),
        'utc_offset' => 0,
        'is_utc'     => true,
        'date'       => '10/29/2022',
        'time'       => '12:00 AM',
        'datetime'   => '10/29/2022 12:00 AM',
        'for_human'  => '10 hours from now',
    ]);
})->with([
    [
        [
            'year'   => 2022,
            'month'  => '10',
            'day'    => '28',
            'hour'   => '17',
            'minute' => 0,
            'second' => 0,
            'tz'     => 'America/Phoenix',
        ],
    ],
]);
