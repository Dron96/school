<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserToPupilRequest;
use App\Http\Requests\AddUserToWorkerRequest;
use App\Http\Requests\GetClassRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Pupil;
use App\Models\User;
use App\Models\Worker;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return User[]|Collection
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Регистрация нового пользователя
     *
     * @param RegisterRequest $request
     * @return Response
     */
    public function register(RegisterRequest $request)
    {
        return User::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return User
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * @param AddUserToPupilRequest $request
     * @param User $user
     * @return void
     */
    public function setRoleAsPupil(AddUserToPupilRequest $request)
    {
        $validatedData = $request->validated();

        return Pupil::create($validatedData);
    }

    /**
     * @param AddUserToWorkerRequest $request
     * @param User $user
     * @return void
     */
    public function setRoleAsWorker(AddUserToWorkerRequest $request)
    {
        $validatedData = $request->validated();

        return Worker::create($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return string
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return 'Пользователь успешно удален';
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return User
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return $user;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllWorker()
    {
        return Worker::with('user')->get();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllPupils()
    {
        return Pupil::with('user')->get();
    }

    /**
     * @param GetClassRequest $request
     * @return mixed
     */
    public function getPupilsFromClass(GetClassRequest $request)
    {
        $class = $request->validated();

        return Pupil::where('class', $class['class'])
            ->where('parallel', $class['parallel'])
            ->with('user')
            ->get();
    }
}
