<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeOffSaveRequest;
use App\Http\Requests\UserSaveRequest;
use App\Http\Resources\Api\CarResource;
use App\Http\Resources\Api\SchoolResource;
use App\Http\Resources\Api\StudentResource;
use App\Http\Resources\Api\TimeOffResource;
use App\Http\Resources\Api\UserResource;
use App\Http\Resources\InstructorResource;
use App\Jobs\PhoneSaveJob;
use App\Jobs\SaveEntityAddressJob;
use App\Models\Car;
use App\Models\Instructor;
use App\Models\School;
use App\Models\Student;
use App\Models\TimeOff;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile()
    {
        /**
         * @get('/profile')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         *
         * @get('/my-profile')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $user = auth()->user();
        $user->load(['address.state', 'notes', 'ratings', 'phone']);

        $rtv_user = null;
        $user_type = null;
        $extra_props = [];

        switch (true) {
            case $user instanceof Student:
                $user_type = 'student';
                $user->load(['school.address.state', 'rating']);
                $rtv_user = StudentResource::make($user);
                $extra_props['schools'] = SchoolResource::collection(School::all());
                break;
            case $user instanceof Instructor:
                $user_type = 'instructor';
                $extra_props['cars'] = CarResource::collection(Car::all());
                $extra_props['schools'] = SchoolResource::collection(School::all());
                $user->load(['car', 'school.address.state']);
                $rtv_user = InstructorResource::make($user);
                break;
            case $user instanceof User:
                $user_type = 'user';
                $rtv_user = UserResource::make($user);
                break;
        }

        return inertia(
            'Profile',
            [
                'user'      => $rtv_user,
                'user_type' => $user_type,
            ] + $extra_props
        );
    }

    public function save(UserSaveRequest $request)
    {
        /**
         * @put('/profile')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $data = $request->validated();

        auth()->user()->update($data);

        if ($request->input('phone')) {
            $this->dispatch(
                new PhoneSaveJob(
                    entity: auth()->user(),
                    phone: $request->phone,
                )
            );
        }

        if ($data['address']) {
            $new_address = $this->dispatch(
                new SaveEntityAddressJob(
                    entity: auth()->user(),
                    address: $data['address'],
                )
            );
        }

        return redirect()->back();
    }

    public function timeoff()
    {
        /**
         * @get('/profile/timeoff')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('InstructorTimeoff/Show', [
            'timeoff_requests' => TimeOffResource::collection(auth()->user()->timeoffRequests),
        ]);
    }

    public function timeoff_edit(TimeOffSaveRequest $request, TimeOff $time_off)
    {
        $time_off->update($request->validated());

        return redirect()->back();
    }

    public function timeoff_add(TimeOffSaveRequest $request)
    {
        /** @var Instructor $user */
        $user = auth()->user();
        $user->timeoffRequests()->create($request->validated());

        return redirect()->back();
    }
}
