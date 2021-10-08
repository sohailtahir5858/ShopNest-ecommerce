<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// we will use Hash to encript our password

class AdminController extends Controller
{

    public function index()
    {
        if(session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
    }


    function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = $request->post('email');
        $password = $request->post('password');

        $result = Admin::where(['email' => $email])->first();

        if ($result) {
            // if email matches and we get data. now we have to compare the encrypted password with the real one. for this we have to first decrypt our password
            if (Hash::check($request->post('password'), $result->password)) {
                $request->session()->put('ADMIN_ID', $result->id);
                $request->session()->put('ADMIN_LOGIN', 'true');
                $request->session()->put('ADMIN_EMAIL', $result->email);
                return redirect('admin/dashboard');
            } else {
                $request->session()->flash('msg', 'Inavlid Password provided');
                return redirect('/admin');
            }
        } else {
            $request->session()->flash('msg', 'Inavlid Data provided');
            return redirect('/admin');
        }
        // print_r($result[0]->id);
        // die();



    }

    function dashboard()
    {
        return view('admin.dashboard');
    }

    function encriptePassword()
    {
        // since we have only one row in admins table so it will return it
        $result = Admin::find(1);

        // incase of register the following code would have been
        // $pass = $request->post('password);
        // $result->password=Hash::make($pass);
        $result->password = Hash::make('1234');

        // after encripting, we will save the password
        $result->save();

        // now our password will be hashed
    }

    function logout(){
        session()->flush();
        return redirect('/admin');
    }
}
