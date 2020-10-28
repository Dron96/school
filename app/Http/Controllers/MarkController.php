<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRequest;
use App\Http\Requests\MarkCreateRequest;
use App\Http\Requests\MarkUpdateRequest;
use App\Models\Mark;
use App\Models\Pupil;
use App\Models\Subject;
use App\Models\Worker;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Mark[]|Collection
     */
    public function index()
    {
        return Mark::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MarkCreateRequest $request
     * @return Response
     */
    public function store(MarkCreateRequest $request)
    {
        return Mark::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Mark $mark
     * @return Mark
     */
    public function show(Mark $mark)
    {
        return $mark;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Mark
     */
    public function update(MarkUpdateRequest $request, Mark $mark)
    {
        $mark->update($request->validated());

        return $mark;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Mark $mark
     * @return string
     * @throws Exception
     */
    public function destroy(Mark $mark)
    {
        $mark->delete();

        return 'Оценка успешно удалена';
    }

    public function getClassMarks(ClassRequest $request)
    {
        $class = $request->validated();
        $marks = Mark::whereHas('pupil', function (Builder $query) use ($class) {
            $query->where('class', $class['class'])
                ->where('parallel', $class['parallel']);
        })->get();

        $mean = $marks->average('mark');
        $count = $marks->count();

        return ['Средняя оценка в классе:' => $mean,
            'Всего оценок в классе' => $count,
            'Все оценки класса' => $marks];
    }

    public function getPupilMarks(Pupil $pupil)
    {
        return $pupil->marks;
    }

    public function getTeacherMarks(Worker $worker)
    {
        return $worker->marks;
    }

    public function getSubjectMarks(Subject $subject)
    {
        return $subject->marks;
    }
}
