<?php

namespace App\Listeners;

use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Stancl\Tenancy\Events\TenantCreated;

class TenantCreateAdminUserListener
{
    /**
     * Handle the event.
     *
     * @param  TenantCreated  $event
     * @return void
     */
    public function handle(TenantCreated $event): void
    {
        $event->tenant->run(function ($tenant) {
            $resource_abilities = [
                'index',
                'create',
                'edit',
                'show',
                'delete',
            ];

            $appointment_abilities = [
                'appointment.assign',
                'appointment.reschedule',
                'appointment.reschedule',
            ];

            $instructor_abilities = array_merge(
                [
                    'dropdown.index',
                    'state.index',
                    'student_type.index',
                    'instructor.profile',
                ],
                $appointment_abilities,
                array_map(fn ($ability) => "car.{$ability}", $resource_abilities),
                array_map(fn ($ability) => "course.{$ability}", $resource_abilities),
                array_map(fn ($ability) => "instructor.{$ability}", $resource_abilities),
                array_map(fn ($ability) => "note.{$ability}", $resource_abilities),
                array_map(fn ($ability) => "rating.{$ability}", $resource_abilities),
                array_map(fn ($ability) => "school.{$ability}", $resource_abilities),
                array_map(fn ($ability) => "special_event.{$ability}", $resource_abilities),
                array_map(fn ($ability) => "special_event.{$ability}", $resource_abilities),
                array_map(fn ($ability) => "student.{$ability}", $resource_abilities),
                array_map(fn ($ability) => "timeoff.{$ability}", $resource_abilities),
            );

            $user_abilities = array_merge(
                [
                    'dropdown.index',
                    'state.index',
                    'student.profile',
                ],
            );

            $student_abilities = array_merge(
                [
                    'dropdown.index',
                    'state.index',
                    'student.profile',
                ],
            );

            (new Collection(File::allFiles(app_path('Models'))))
                ->map(fn ($f) => $f->getFilenameWithoutExtension())
                ->map(fn ($f) => [$f, \Str::snake($f)])
                ->map(fn ($f) => $f + \Arr::map($resource_abilities, fn ($ability) => "{$f[1]}.{$ability}"))
                ->each(function ($model_abilities) {
                    $model_name = array_shift($model_abilities);
                    $model_slug = array_shift($model_abilities);

                    // make sure admins can do everything
                    \Bouncer::allow('admin')->to($model_abilities);
                });

            // Model specific abilities
            \Bouncer::allow('admin')->to($appointment_abilities);

            // build instructor abilities
            \Bouncer::allow('instructor')->to($instructor_abilities);

            // build student abilities
            \Bouncer::allow('instructor')->to($student_abilities);

            // build user abilities
            \Bouncer::allow('user')->to($user_abilities);

            $tenant_admin = User::factory()->create([
                'first_name' => 'admin',
                'last_name'  => 'admin',
                'email'      => "admin@{$tenant->id}.".config('tenancy.included_domain'),
            ]);

            $tenant_admin->assign('admin');

            Instructor::factory()
                ->forCar()
                ->hasPhone()
                ->hasAddress()
                ->create([
                    'email' => "instructor@{$tenant->id}.".config('tenancy.included_domain'),
                ])
                ->each(fn ($instructor) => $instructor->assign('instructor'));

            Student::factory()
                ->hasPhone()
                ->hasAddress()
                ->create([
                    'email' => "student@{$tenant->id}.".config('tenancy.included_domain'),
                ])
                ->each(fn ($student) => $student->assign('student'));

            User::factory()
                ->hasPhone()
                ->hasAddress()
                ->create([
                    'email' => "user@{$tenant->id}.".config('tenancy.included_domain'),
                ])
                ->each(fn ($user) => $user->assign('user'));
        });
    }
}
