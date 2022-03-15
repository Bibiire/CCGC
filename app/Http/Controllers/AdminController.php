<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function Index(){
        return view('admin.admin_login');
    }

    public function Dashboard(){
        return view('admin.index');
    }

    public function Login(Request $request){
        // dd($request->all());

        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check ['email'], 'password' => $check['password'] ])){
            return redirect()->route('admin.dashboard')->with('error','Admin Login Is Successful');
        }else{
            return back()->with('error','Invalid Email or Password');
        }

    }

    public function AdminLogout(){

        Auth::guard('admin')->logout();
        return redirect()->route('login_from')->with('error','Admin Logout Is Successful');
    }

    public function AdminRegister(){

        return view('admin.admin_register');
    }

    public function AdminRegisterCreate(Request $request){
        // dd($request->all());

        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),

        ]);

        return redirect()->route('login_from')->with('error','Admin Created Is Successful');


    }
}
