<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserToPupilRequest;
use App\Http\Requests\AddUserToWorkerRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Pupil;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
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
     * @param Request $request
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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function setRoleAsPupil(AddUserToPupilRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user->id;
        return Pupil::create($validatedData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function setRoleAsWorker(AddUserToWorkerRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user->id;
        return Worker::create($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
