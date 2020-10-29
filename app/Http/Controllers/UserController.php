<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserToPupilRequest;
use App\Http\Requests\AddUserToWorkerRequest;
use App\Http\Requests\ClassRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Pupil;
use App\Models\User;
use App\Models\Worker;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }

    /**
     * Авторизация пользователя
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json([
                'errors' => 'Адрес электронной почты или пароль неправильные',
            ], 401);
        }
        $token = Auth::user()->createToken('authToken');

        return response()->json([
            'user' => auth()->user(),
            'access_token' => $token->accessToken,
        ], 200);
    }

    /**
     * Выход из пользователя
     *
     * @return JsonResponse
     */
    public function logout()
    {
        Auth::user()->token()->revoke();

        return response()->json([
            'message' => 'Вы успешно вышли',
        ], 200);
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
     * @return void
     */
    public function setRoleAsPupil(AddUserToPupilRequest $request)
    {
        $validatedData = $request->validated();

        return Pupil::create($validatedData);
    }

    /**
     * @param AddUserToWorkerRequest $request
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
     * @param ClassRequest $request
     * @return mixed
     */
    public function getPupilsFromClass(ClassRequest $request)
    {
        $class = $request->validated();

        return Pupil::where('class', $class['class'])
            ->where('parallel', $class['parallel'])
            ->with('user')
            ->get();
    }

    public function dismissWorker(Worker $worker)
    {
        $worker->update(['dismissal_date' => now()]);

        return $worker;
    }

    public function changeClassForPupil(ClassRequest $request, Pupil $pupil)
    {
        $pupil->update($request->validated());

        return $pupil;
    }

    public function getWorkerSchedule(Worker $worker)
    {
        return $worker->subjects()->with('schedules')->get();
    }
}
