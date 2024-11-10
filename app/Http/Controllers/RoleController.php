<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index(){

        $data['Roles'] = Role::select('id' ,'name')->get();
        
        return view('Backend.Role.index' , $data );
    }

    public function assignRole(){

        $data['Roles'] = Role::get();
        $data['Users'] = User::get();
        
        return view('Backend.Role.create' ,$data);
    }

    public function storeAssignRole(Request $request)
    {
        
        DB::beginTransaction();
        try {
            if ($request->input('user_id') == 0 ) {
                $this->SetMessage('User must be select' , 'danger');
                return redirect()->back()->WithInput();
            }
            if ( $request->input('role_id') == 0) {
                $this->SetMessage('Role must be select' , 'danger');
                return redirect()->back()->WithInput();
            }

            // Validate the request
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'role_id' => 'required|integer',
            ]);
    

            if($validator->fails()){
                return redirect()->back()->WithErrors($validator)->WithInput();
            }
    
            // Find the user by user_id
            $user = User::find($request->input('user_id'));
            if (!$user) {
                $this->SetMessage('User not found' , 'danger');
                return redirect()->back();
            }
    
            // Find the role by role_id
            $role = Role::find($request->input('role_id'));
            if (!$role) {
                $this->SetMessage('Role not found' , 'danger');
                return redirect()->back();
            }
    
            // If the user already has a role, return an error
            if ($user->role()->exists()) {
                $this->SetMessage('User already has a role' , 'danger');
                return redirect()->back()->WithInput();
            }
    
            // Assign the role to the user
            $user->role()->associate($role);
            $user->save();
    
            $this->SetMessage('Role assigned successfully' , 'success');

            $data['users'] = User::with('role')->get();

            DB::commit();
            
            return redirect('/users')->with($data);

        } catch (\Exception $exception) {
            DB::rollback();
            $this->SetMessage($exception->getMessage() , 'danger');
            return redirect()->back();
        }
    }

}
