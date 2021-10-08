<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $data['result'] = Coupon::all();


        return view('admin/coupon/coupon', $data);
    }

    function manage_coupon_action(Request $request, $id = '')
    {

        if ($id > 0) {
            // mean we got the ID and we ahve to edit it now. so we will get the data of this id and send it to the form
            $arr = Coupon::where(['id' => $id])->get();
            $data['title'] = $arr['0']->title;
            $data['code'] = $arr['0']->code;
            $data['value'] = $arr['0']->value;
            $data['type'] = $arr['0']->type;
            $data['min_order_amount'] = $arr['0']->min_order_amount;
            $data['is_one_time'] = $arr['0']->is_one_time;
            $data['id'] = $arr['0']->id;
        } else {
            // since we didn't get the ID, so we have to insert it. therefore we will return the insrt form

            $data['title'] = '';
            $data['code'] = '';
            $data['id'] = 0;
            $data['value'] = '';
            $data['type'] = '';
            $data['min_order_amount'] = '';
            $data['is_one_time'] = '';
        }
        return view('admin/coupon/manage_coupon', $data);
    }

    // function to add and edit category
    // adding or edditing will be decided based on the hidden ID that we have passed
    function manage_coupon_process(Request $request)
    {

        $id = $request->post('id');


        $request->validate([
            'title' => 'required|unique:coupons,title,' . $id,
            'code' => 'required|unique:coupons,code,' . $id,
            'value' => 'required',
            'type' => 'required',
            'min_order_amount' => 'required',
            'is_one_time' => 'required',

        ]);

        $title = $request->post('title');
        $code = $request->post('code');
        $value = $request->post('value');
        $type = $request->post('type');
        $min_order_amount = $request->post('min_order_amount');
        $is_one_time = $request->post('is_one_time');



        if ($id > 0) {
            $result = Coupon::find($id);
            $msg = "Coupon Inserted Succesfull";
        } else {
            $result = new Coupon();
            $msg = "Coupon Updated Succesfull";
            $result->created_at = date('Y-m-d');
        }
        $result->title = $title;
        $result->code = $code;
        $result->value = $value;
        $result->type = $type;
        $result->min_order_amount = $min_order_amount;
        $result->is_one_time = $is_one_time;
        $result->updated_at = date('Y-m-d');
        $result->status = 1;
        $result->save();
        session()->flash('msg', $msg);
        return redirect('admin/coupon');
    }

    function delete($id)
    {
        $result = Coupon::find($id);
        $result->delete();
        session()->flash('msg', 'Coupon Deleted Succesfull');
        return redirect('admin/coupon');
    }

    function status(Request $request,$status, $id){
        $result = Coupon::find($id);
        $result->status = $status;
        $result->save();

        $request->session()->flash('msg','Status Updated successfull');
        return redirect('admin/coupon');
    }
}
