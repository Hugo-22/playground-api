<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
    )
    {
    }

    public function all(Request $request)
    {
        $gender = $request->get('gender');

        $users = $gender ? User::where('gender', $gender)->get() : User::all();

        // log test for telescope
//        Log::error('some error', ['erreur' => 'le message d\'erreur...', 'other stuff' => 'more info here']);
        return response()->json($users);
    }


    public function store(UserPostRequest $request)
    {
        $user = User::create(
            array_merge($request->toArray(), ["password" => "password"])
        );
        return response()->json($user);
    }
}
