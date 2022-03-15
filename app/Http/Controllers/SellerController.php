<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SellerController extends Controller
{
    public function SellerIndex(){
        return view('seller.seller_login');
    }

    public function SellerDashboard(){
        return view('seller.index');

    }

    public function SellerLogin(Request $request){
        // dd($request->all());

        $check = $request->all();
        if(Auth::guard('seller')->attempt(['email' => $check ['email'], 'password' => $check['password'] ])){
            return redirect()->route('seller.dashboard')->with('error','Seller Login Is Successful');
        }else{
            return back()->with('error','Invalid Email or Password');
        }

    }

    public function SellerLogout(){
        Auth::guard('seller')->logout();
        return redirect()->route('seller_login_from')->with('error','Seller Logout Is Successful');
    }

    public function SellerRegister(){

        return view('seller.seller_register');
    }

    public function SellerRegisterCreate(Request $request){
        // dd($request->all());

        Seller::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),

        ]);

        return redirect()->route('seller_login_from')->with('error','Seller Created Is Successful');


    }
}
