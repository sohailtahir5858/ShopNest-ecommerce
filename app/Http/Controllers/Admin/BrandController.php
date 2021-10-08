<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $data['result'] = Brand::all();


        return view('admin/brand/brand', $data);
    }

    function manage_brand_action(Request $request, $id = '')
    {

        if ($id > 0) {
            // mean we got the ID and we ahve to edit it now. so we will get the data of this id and send it to the form
            $arr = Brand::where(['id' => $id])->get();

            $data['name'] = $arr['0']->name;
            $data['image'] = $arr['0']->image;
            $data['is_home'] = $arr['0']->is_home;
            $data['id'] = $arr['0']->id;
        } else {
            // since we didn't get the ID, so we have to insert it. therefore we will return the insrt form

            $data['name'] = '';
            $data['image'] = '';
            $data['is_home'] = '';
            $data['id'] = 0;
        }
        return view('admin/brand/manage_brand', $data);
    }

    // function to add and edit category
    // adding or edditing will be decided based on the hidden ID that we have passed
    function manage_brand_process(Request $request)
    {

        $id = $request->post('id');

        if ($id > 0) {
            $img_validate = 'mimes:jpg,png,jpeg';
        } else {
            $img_validate = 'required|mimes:jpg,png,jpeg';
        }

        $request->validate([
            'name' => 'required|unique:brands,name,' . $id,
            'image' => $img_validate,
            'is_home' => 'required',
        ]);




        if ($id > 0) {
            $result = Brand::find($id);

            if($request->hasFile('image')) {
            $old_image = $result->image;
            $old_image_file = 'storage/media/brand' . '/' . $old_image;
            if (file_exists($old_image_file)) {
                unlink($old_image_file);
            }
        }
            $msg = "Brand Inserted Succesfull";
        } else {
            $result = new Brand();
            $msg = "Brand Updated Succesfull";
            $result->created_at = date('Y-m-d');
        }
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_file = time() . '.' . $ext;
            $image->storeAs('public/media/brand' . '/', $image_file);
            $result->image = $image_file;
        }
        $name = $request->post('name');
        $is_home = $request->post('is_home');
        $result->name = $name;
        $result->is_home = $is_home;
        $result->status = 1;
        $result->updated_at = date('Y-m-d');
        $result->save();
        session()->flash('msg', $msg);
        return redirect('admin/brand');
    }

    function delete($id)
    {
        $result = Brand::find($id);

        $image_name = $result->image;

        $image_file = 'storage/media/brand' . '/' . $image_name;
        if (file_exists($image_file)) {
            unlink($image_file);
        }
        $result->delete();
        session()->flash('msg', 'Brand Deleted Succesfull');
        return redirect('admin/brand');
    }

    function status(Request $request, $status, $id)
    {

        $result = Brand::find($id);
        $result->status = $status;
        $result->save();
        $request->session()->flash('msg', 'Status Updated succesfull');
        return redirect('admin/brand');
    }
}
