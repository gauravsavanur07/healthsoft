<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Fascades\Hash;
use Illuminate\Support\Fascades\Validator;



class RegisterController extends Controller
{
    //

    protected function validator(array $data){
        return Validator::make($data, [ 
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender'=>'required'
        ]);
    
    
    }

    protected function create(array $data){
        $role = Role::where('name','patient')->first();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id'=>$role->id,
            'gender'=>$data['gender'],
        ]);
    }

    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();
        $role = Role::where('name','patient')->first();
        $data['name'] = 'name';
        $data['email'] = 'email';
        $data['role_id'] = $role->id;
        $data['gender'] = 'gender';


        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->back()->with('message','User has been added successfully');


        
    }
    
}
