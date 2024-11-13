<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Jobs\SendWelcomeEmailJob;

class AuthController extends Controller
{
    // User registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->error('Validation failed', 422, $validator->errors());
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            SendWelcomeEmailJob::dispatch($user);

            DB::commit();


            return response()->success(['message' => 'User Register Successful', 'status'=> true]);
        } catch(\Exception $exception){
            DB::rollback();
            return response()->error('User Register Unsuccessful', 422, $exception->getMessage());
        }
    }

    // User login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->error('Validation failed', 422, $validator->errors());
        }

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->error('Invalid credentials', 422,'Invalid credentials');
            }else{
               return response()->success(['message' => 'User Login Successful','token' => $user->createToken('EcommerceApp')->plainTextToken, 'status'=> true]);
            }
        } catch(\Exception $exception){
            return response()->error(422, $exception->getMessage());
        }
    }

    // User logout
    public function logout(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->user()->currentAccessToken()->delete();
            DB::commit();

            return response()->success(['message' => 'Logged out successfully', 'status'=> true]);
        } catch(\Exception $exception){
            DB::rollback();
            return response()->error('Logged out Unsuccessful', 422, $exception->getMessage());
        }
    }

    public function index(){
        $data['users'] = User::with('role')->get();
        return view('Backend.User.index' , $data );
    }

    
}

