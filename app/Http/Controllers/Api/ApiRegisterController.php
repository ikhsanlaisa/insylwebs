<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class ApiRegisterController extends Controller
{
    public function register(Request $request)
    {
        $credentials = $request->only('nama', 'email', 'password', 'roles');

        $rules = [
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        $name = $request->nama;
        $email = $request->email;
        $password = $request->password;
        $roles = $request->roles = 2;

        $user = User::create(['nama' => $name, 'email' => $email, 'roles' => $roles, 'password' => Hash::make($password)]);
//        $verification_code = str_random(30); //Generate verification code
//        DB::table('user_verifications')->insert(['user_id' => $user->id, 'token' => $verification_code]);
//        $subject = "Please verify your email address.";
//        Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
//            function($mail) use ($email, $name, $subject){
//                $mail->from(getenv("4nesia"), 'ikhsanlaisa@4nesia.com');
//                $mail->to($email, $name);
//                $mail->subject($subject);
////            });
        return response()->json(['success' => true, 'message' => 'Thanks for signing up!.']);
    }

//    public function verifyUser($verification_code)
//    {
//        $check = DB::table('user_verifications')->where('token',$verification_code)->first();
//
//        if(!is_null($check)){
//            $user = User::find($check->user_id);
//
//            if($user->is_verified == 1){
//                return response()->json([
//                    'success'=> true,
//                    'message'=> 'Account already verified..'
//                ]);
//            }
//
//            $user->update(['is_verified' => 1]);
//            DB::table('user_verifications')->where('token',$verification_code)->delete();
//
//            return response()->json([
//                'success'=> true,
//                'message'=> 'You have successfully verified your email address.'
//            ]);
//        }
//
//        return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);
//
//    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $input = $request->only('email', 'password');

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success' => false, 'error' => $error]);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(['success' => true, 'data' => ['token' => $token]]);
    }
}
