<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        // $credentials = request(['email', 'password']);
        // \dd($credentials,$request->all());
        if (auth()->attempt($request->all())) {
            $user = auth()->user();
            $success['token'] = $user->createToken('appToken')->accessToken;
            //After successfull authentication, notice how I return json parameters
            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => $user
            ]);
        } else {
            //if authentication is unsuccessfull, notice how I return json parameters
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }

    /**
     * Register api.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'phone' => 'required|unique:users|regex:/(0)[0-9]{9}/',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }
        try {
            $dev_role = Role::where('slug', $request->role)->first();
            // $dev_perm = Permission::where('slug', 'create-tasks')->first();
    
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            $user->roles()->attach($dev_role);
            // $user->permissions()->attach($dev_perm);
    
            $success['token'] = $user->createToken('appToken')->accessToken;
        } catch (\Throwable $th) {
            throw $th;
            return $th;
        }

        return response()->json([
            'success' => true,
            'token' => $success,
            'user' => $user
        ]);
    }

    public function logout(Request $res)
    {
        if (Auth::user()) {
            $user = Auth::user()->token();
            $user->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to Logout'
            ]);
        }
    }

    public function user()
    {
        // $user = User::all();
        $user = Auth::user();
        // return $user;
        return response()->json(['success' => $user], 200);
    }
}
