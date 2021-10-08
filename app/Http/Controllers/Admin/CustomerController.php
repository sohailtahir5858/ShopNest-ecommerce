<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data['result'] = Customer::all();


        return view('admin/customer/customer', $data);
    }

    // function to add and edit category
    // adding or edditing will be decided based on the hidden ID that we have passed
    
    function show(Request $request, $id){
        $arr = Customer::where(['id' => $id])->get();

        $data['customer_list']=$arr['0'];
        return view('admin/customer/show_customer',$data);
    }

    function delete($id)
    {
        $result = Customer::find($id);
        $result->delete();
        session()->flash('msg', 'Customer Deleted Succesfull');
        return redirect('admin/customer');
    }

    function status(Request $request,$status, $id){
        
        $result = Customer::find($id);
        $result->status = $status;
        $result->save();
       $request->session()->flash('msg','Customer Status Updated succesfull');
        return redirect('admin/customer');
    }
}
