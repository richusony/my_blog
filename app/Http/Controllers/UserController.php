<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUserRegisterPage() {
        return view('register');
    }

    public function userRegister(Request $request)
    {
        $fullName = $request->fullname;
        $email = $request->email;
        $password = $request->password;

        if (!$fullName) {
            // return response()->json(['error' => 'Fullname is required']);
            return redirect('register', 400)->with('error', 'Fullname is required');

        }   
        if (!$email) {
            // return response()->json(['error' => 'Email is required']);
            return redirect()->with('error', 'Email is required');
        }
        if (!$password) {
            return redirect()->with('error', 'Password is required');
        }

        try {
            $userExistsWithEmail = DB::table('users')->where('email', $email)->first();
            if ($userExistsWithEmail) {
                return response()->json(['error' => 'User already existed with this email']);
            }

            $user = new User();

            $user->name = $fullName;
            $user->email = $email;
            $user->password = $password;

            $user->save();

            // return response()->json(['success', 'User has been created']);
            return redirect('/')->with('success', 'User has been created');
        } catch (\Exception $e) {
            return redirect()->with('error', 'Something went wrong while registering. Please try again later');
            // return response()->json(['error' => 'Something went wrong while registering. Please try again later']);
        }
    }

    public function userLogin(Request $request)
    {
        // $email = $request->email;
        // $password = $request->passowrd;

        // if (!$email) {
        //     return response(400)->json(['error' => 'Email is required']);
        // }
        // if (!$password) {
        //     return response(400)->json(['error' => 'Password is required']);
        // }

        // try {
        //     $userExistsWithEmail = DB::table('users')->where('email', $email)->first();
        //     if (!$userExistsWithEmail) {
        //         return response(404)->json(['error' => 'User not found with this email']);
        //     }

        //     if ($userExistsWithEmail->password != $password) {
        //         return response(401)->json(['error' => 'Invalid Creadentials']);
        //     }

        //     return response()->json(['success', 'User has been logged in successfully']);
        // } catch (\Exception $e) {
        //     // return redirect()->with('error', 'Something went wrong while registering. Please try again later');
        //     return response()->json(['error' => 'Something went wrong while registering. Please try again later']);
        // }

        try {
            $userExistsWithEmail = DB::table('users')
                ->where('email', 'test@gmail.com')
                ->first();

            if (!$userExistsWithEmail) {
                $user = new User();

                $user->name = "Richu Sony";
                $user->email = "test@gmail.com";
                $user->password = "testPassword";
                $user->save();
            }

            return response()->json(['success' => 'User logged in successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong while registering. Please try again later']);
        }
    }
}
