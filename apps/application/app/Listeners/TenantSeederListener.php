<?php

namespace App\Listeners;

use App\Models\AppointmentType;
use App\Models\Course;
use App\Models\PaymentType;
use App\Models\School;
use App\Models\Status;
use App\Models\StudentType;
use App\Models\TestLocation;
use App\Models\User;
use Illuminate\Support\Str;
use Stancl\Tenancy\Events\TenantCreated;

class TenantSeederListener
{
    /**
     * Handle the event.
     *
     * @param  TenantCreated  $event
     * @return void
     */
    public function handle(TenantCreated $event): void
    {
        $event->tenant->run(function () {
            $user_types = [
                [
                    'name'            => 'Active',
                    'value'           => 'Active',
                    'statusable_type' => User::class,
                ],
                [
                    'name'            => 'Inactive',
                    'value'           => 'Inactive',
                    'is_inactive'     => true,
                    'statusable_type' => User::class,
                ],
            ];

            array_walk($user_types, fn ($user_type) => Status::create($user_type));

            $payment_types = [
                'cash',
                'card',
                'manual',
            ];

            foreach ($payment_types as $payment_type) {
                $find = ['name' => $payment_type];
                PaymentType::firstOrCreate($find, $find);
            }

            School::factory()
                ->count(5)
                ->hasAddress()
                ->hasPhone()
                ->create();

            TestLocation::factory()
                ->count(5)
                ->hasAddress()
                ->create();

            $student_types = [
                'teen',
                'audit',
            ];

            array_walk($student_types, function ($name) {
                $label = Str::of($name)->ucfirst();

                return StudentType::create(compact('name', 'label'));
            });

            $appointment_types = [
                [
                    'name'        => 'Class',
                    'duration'    => '60',
                    'is_test'     => false,
                    'test_offset' => 0,
                ],
                [
                    'name'        => 'Class Test',
                    'duration'    => '60',
                    'is_test'     => true,
                    'test_offset' => 45,
                ],
                [
                    'name'        => 'Driving Test',
                    'duration'    => '60',
                    'is_test'     => true,
                    'test_offset' => 45,
                ],
            ];

            array_walk($appointment_types, fn ($appointment_type) => AppointmentType::create($appointment_type));

            Course::factory()->create();
        });
    }
}
