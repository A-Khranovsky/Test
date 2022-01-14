<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function userTasks()
    {
        $user_id = Auth::id();
        $tasks = User::find($user_id)->tasks;
        return view('index', ['tasks' => $tasks]);

    }

    public function callback(Request $request)
    {
        $parameters = [
            'client_id' => config('oauth.google.client_id'),
            'client_secret' => config('oauth.google.secret_key'),
            'grant_type' => 'authorization_code',
            'code' => $request->get('code'),
            'redirect_uri' => config('oauth.google.call_back')
        ];

        $response = Http::asForm()->post('https://www.googleapis.com/oauth2/v4/token', $parameters);
        $token = $response->json('access_token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('https://www.googleapis.com/oauth2/v3/userinfo');


        $user = User::updateOrCreate([
                'email' => $response->json('email')
            ],
            [
                'name' => $response->json('email'),
                'email' => $response->json('email'),
                'password' => Hash::make(Str::random(10)),
            ]);

        Auth::login($user);
        return redirect('tasks'.'?token='.$user->createToken('web')->plainTextToken);
        //I Have put token to the url for test of this app
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
