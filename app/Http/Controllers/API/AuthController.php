<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
			$request->validate([
				'email'	=>	['required','email'],
				'password'	=> ['required','string']
			]);
			$http = new \GuzzleHttp\Client;

			try {
				$response = $http->post(config('services.passport.login_endpoint'), [
					'form_params' => [
							'grant_type' => 'password',
							'client_id' => config('services.passport.client_id'),
							'client_secret' => config('services.passport.client_secret'),
							'username' => $request->email,
							'password' => $request->password,
							],
					]);
					
					return $response->getBody();

			} catch (\Throwable $e) {
				if ($e->getCode() === 400) {
					return response()->json('Invalid Request. Please enter a email or a password.', $e->getCode());
				} else if ($e->getCode() === 401 ) {
						return response()->json('Your credentials are incorrect. Please try again.', $e->getCode());
				}
				return response()->json('Something went wrong on the server.', $e->getCode());
			}			
		}

		public function register(Request $request) {
			$request->validate([
				'name'	=>	['required','string'],
				'email'	=>	['required','email','unique:users,email'],
				'roles'	=>	['required',Rule::in(['admin','teacher','student'])],
				'password'	=> ['required','string','confirmed'],
				'password_confirmation'	=> ['required','string']
			]);

			$data = $request->all();
			$data['password']	= Hash::make($request->password);

			$user = User::create($data);

			switch ($user->roles) {
				case 'student':
					Student::create([
						'user_id'       		=> $user->id,
						'nisn'           		=> null,
						'gender'        		=> '',
						'date_of_birth' 		=> '',
						'address'       		=> '',
						'expertise_program' => '',
						'photo'         		=> "http://api.tryout.test/images/user/default.png"
				]);
					break;
				case 'teacher' :
					Teacher::create([
						'user_id'       => $user->id,
						'nip'           => null,
						'gender'        => '',
						'date_of_birth' => '',
						'address'       => '',
						'lesson'        => '',
						'photo'         => 'http://api.tryout.test/images/user/default.png'
				]);
					break;
				default:
					return response("404", 404);
					break;
			}

			return response()->json('successfully',200);
		}

		public function logout() {
			return response()->json(auth()->id());
			// get auth from user, get token from user , each token will be deleted
			auth()->user()->tokens()->each(function($token, $key) {
					$token->delete();
			});


			return response()->json('Logged out successfully', 200);
	}
		
}
