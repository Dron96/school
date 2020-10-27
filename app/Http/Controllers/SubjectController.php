<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Models\Subject;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Subject[]|Collection|Response
     */
    public function index()
    {
        return Subject::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSubjectRequest $request
     * @return Response
     */
    public function store(CreateSubjectRequest $request)
    {
        return Subject::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Subject $subject
     * @return Subject
     */
    public function show(Subject $subject)
    {
        return $subject;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubjectUpdateRequest $request
     * @param Subject $subject
     * @return Subject
     */
    public function update(SubjectUpdateRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return $subject;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subject $subject
     * @return string
     * @throws Exception
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return 'Предмет успешно удален из списка предметов';
    }
}
