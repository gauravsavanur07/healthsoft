<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
