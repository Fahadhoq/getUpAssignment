<?php

namespace App\Http\Controllers;

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
            DB::commit();

            SendWelcomeEmailJob::dispatch($user);

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


    public function assignRole(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'role_id' => 'required|integer',
            ]);
    
            if ($validator->fails()) {
                return response()->error('Validation failed', 422, $validator->errors());
            }
    
            // Find the user by user_id
            $user = User::find($request->input('user_id'));
            if (!$user) {
                return response()->error('User not found', 404);
            }
    
            // Find the role by role_id
            $role = Role::find($request->input('role_id'));
            if (!$role) {
                return response()->error('Role not found', 404);
            }
    
            // If the user already has a role, return an error
            if ($user->role()->exists()) {
                return response()->error('User already has a role', 400);
            }
    
            // Assign the role to the user
            $user->role()->associate($role);
            $user->save();
    
            DB::commit();
    
            return response()->success([
                'user' => $user,
                'message' => 'Role assigned successfully',
                'status'=> true
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->error('Role not assigned', 422, $exception->getMessage());
        }
    }
    
}

