<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon; 
use DB; 
use Mail; 

class AuthController extends Controller
{
    public function register(Request $request){
		$post_data = $request->validate([
			'name'=>'required|string',
			'email'=>'required|string|email|unique:users',
			'password'=>'required|min:8'
		]);

		$user = User::create([
			'name' => $post_data['name'],
			'email' => $post_data['email'],
			'password' => Hash::make($post_data['password']),
		]);

		$token = $user->createToken('authToken')->plainTextToken;

		return response()->json([
			'access_token' => $token,
			'token_type' => 'Bearer',
		]);
	}

	public function login(Request $request){
		if (!\Auth::attempt($request->only('email', 'password'))) {
			return response()->json([
				'message' => 'Invalid login details'
			], 401);
		}

		$user = User::where('email', $request['email'])->firstOrFail();

		$token = $user->createToken('authToken')->plainTextToken;

		return response()->json([
				'access_token' => $token,
				'token_type' => 'Bearer',
		]);
	}
	public function forgetpassword(Request $request){
		
		$post_data = $request->validate([
			'email'=>'required|string|email|exists:users'
		]);
		
		$token = Str::random(64);
		
		DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $logo = env('APP_NAME');

        Mail::send('email.forgetPassword', ['token' => $token,'logo' => $logo], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
		
		return response()->json([
				'msg' => 'Email has been sent to your email.'
		]);
	}
	
	public function resetpassword(Request $request){
        $this->validate($request, [
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where('token',$request->token)->first();

        if(!$updatePassword){
            return response()->json([
				'message' => 'Invalid Token'
			], 401);
        }

        $uemail = $updatePassword->email;
        $user = User::where('email', $uemail)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $uemail])->delete();

        return response()->json([
				'msg' => 'Password has been changed.'
		]);
    }
	public function logout() {
		Auth::user()->tokens->each(function($token, $key) {
			$token->delete();
		});
		return response()->json('Successfully logged out');
	}
	
}