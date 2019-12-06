<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Auth\RegisterController;
use App\User;
use Auth;
use Log;

class HomeController extends RegisterController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listUsers = User::get();

        return view('home', compact(
            'listUsers'
        ));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())->with([
            'message'       => 'Create Successfully!',
            'alert-type'    => 'success'
        ]);
    }

    public function deleteUser(Request $request)
    {
        User::find($request->id)->delete();
        $response = [
            'message'       => 'Delete Successfully!',
            'alert-type'    => 'success'
        ];

        return redirect()->route('home')->with($response);
    }
}
