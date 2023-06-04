<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeOffSaveRequest;
use App\Models\Instructor;
use App\Models\TimeOff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstructorTimeoffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Instructor  $instructor
     * @return Response
     */
    public function index(Instructor $instructor)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Instructor  $instructor
     * @return Response
     */
    public function create(Instructor $instructor)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @param  Instructor  $instructor
     * @return Response
     */
    public function store(TimeOffSaveRequest $request, Instructor $instructor)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Instructor  $instructor
     * @param  TimeOff  $timeOff
     * @return Response
     */
    public function show(Instructor $instructor, TimeOff $timeOff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Instructor  $instructor
     * @param  TimeOff  $timeOff
     * @return Response
     */
    public function edit(Instructor $instructor, TimeOff $timeOff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Instructor  $instructor
     * @param  TimeOff  $timeOff
     * @return Response
     */
    public function update(TimeOffSaveRequest $request, Instructor $instructor, TimeOff $timeOff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Instructor  $instructor
     * @param  TimeOff  $timeOff
     * @return Response
     */
    public function destroy(Instructor $instructor, TimeOff $timeOff)
    {
        //
    }
}
