<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSubjectToScheduleRequest;
use App\Http\Requests\ClassRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Schedule[]|Collection|Response
     */
    public function index()
    {
        return Schedule::all();
    }

    /**
     * Display the specified resource.
     *
     * @param Schedule $schedule
     * @return Schedule|Builder[]|Collection
     */
    public function show(Schedule $schedule)
    {
        return $schedule->with('subject')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ScheduleUpdateRequest $request
     * @param Schedule $schedule
     * @return Schedule
     */
    public function update(ScheduleUpdateRequest $request, Schedule $schedule)
    {
        $schedule->update($request->validated());

        return $schedule;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @return string
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return 'Предмет успешно удален из расписания';
    }

    /**
     * @param AddSubjectToScheduleRequest $request
     * @return mixed
     */
    public function addSubjectToSchedule(AddSubjectToScheduleRequest $request)
    {
        $data = $request->validated();
        $data['start_lesson'] = Carbon::createFromFormat('d.m.Y H:i', $request->get('start_lesson'))
            ->format('Y-m-d H:i');
        return Schedule::create($data);
    }

    public function getClassSchedule(ClassRequest $request)
    {
        $subjects = Schedule::where('class', $request->class)
            ->where('parallel', $request->parallel)
            ->with('subject')
            ->get();

        return $subjects;
    }
}
