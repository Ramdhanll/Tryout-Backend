<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use App\Student;
use App\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles' => $data['roles'],  
        ]);



        if ($user->roles === 'admin') {
            Admin::create([
                'user_id'       => $user->id,
                'name'          => $user->name,
                'gender'        => '',
                'date_of_birth' => '',
                'address'       => '',
                'photo'         => 'default.jpg'
            ]);
        } else if ($user->roles === 'student') {
            Student::create([
                'user_id'           => $user->id,
                'nisn'              => null,
                'gender'            => '',
                'date_of_birth'     => '',
                'address'           => '',
                'expertise_program' => '',
                'photo'             => 'default.jpg'
            ]);
        } else if ($user->roles === 'teacher') {
            Teacher::create([
                'user_id'       => $user->id,
                'nip'           => '',
                'gender'        => '',
                'date_of_birth' => '',
                'address'       => '',
                'lesson'        => '',
                'photo'         => 'default.jpg'
            ]);
        }


        return $user;
    }
}
