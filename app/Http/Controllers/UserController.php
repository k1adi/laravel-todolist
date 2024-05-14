<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function loginPage(): Response {
        return response()->view('user.login', [
            'title' => 'Login Page'
        ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse {
        $user = $request->input('user');
        $pass = $request->input('password');

        // Validate input
        if(empty($user) || empty($pass)) {
            return response()->view('user.login', [
                'title' => 'Login',
                'error' => 'User and Password is Required!'
            ]);
        }

        // Validate login
        if($this->userService->login($user, $pass)) {
            $request->session()->put('user', $user);
            return redirect('/');
        }

        return response()->view('user.login', [
            'title' => 'Login',
            'error' => 'User or Password is incorrect!'
        ]);
    }

    public function doLogout(Request $request): RedirectResponse {
        $request->session()->forget('user');
        return redirect('/');
    }
}
