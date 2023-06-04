<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\StudentTypeResource;
use App\Models\StudentType;

class StudentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_types = StudentTypeResource::collection(
            resource: StudentType::all(),
        );

        return inertia()->share(compact('student_types'));
    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Models\StudentType  $studentType
//     * @return \Illuminate\Http\Response
//     */
//    public function show(StudentType $studentType)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\StudentType  $studentType
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, StudentType $studentType)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Models\StudentType  $studentType
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(StudentType $studentType)
//    {
//        //
//    }
}
