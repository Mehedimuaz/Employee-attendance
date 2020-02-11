<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\supervisor;
use App\employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'user_type' => 'required|min:1',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $id = User::max('id');
        if($data['user_type'] == 'employee'){
            $employee = new employee();
            $employee->name = $data['name'];
            $employee->user_id = $id + 1;
            $employee->salary = 0;
            $employee->save();
        }
        else if($data['user_type'] == 'supervisor'){
            $supervisor = new supervisor();
            $supervisor->name = $data['name'];
            $supervisor->user_id = $id + 1;
            $supervisor->save();
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_type' => $data['user_type'],
            'is_active' => 1,
        ]);
    }
}
