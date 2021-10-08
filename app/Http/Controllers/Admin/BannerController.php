<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $data['result'] = Banner::all();


        return view('admin/banner/banner', $data);
    }

    function manage_banner_action(Request $request, $id = '')
    {

        if ($id > 0) {
            // mean we got the ID and we ahve to edit it now. so we will get the data of this id and send it to the form
            $arr = Banner::where(['id' => $id])->get();

            $data['name'] = $arr['0']->name;
            $data['image'] = $arr['0']->image;
            $data['button_text'] = $arr['0']->button_text;
            $data['button_link'] = $arr['0']->button_link;
            $data['short_desc'] = $arr['0']->short_desc;
            $data['status'] = $arr['0']->status;
            $data['id'] = $arr['0']->id;
        } else {
            // since we didn't get the ID, so we have to insert it. therefore we will return the insrt form

            $data['name'] = '';
            $data['image'] = '';
            $data['button_text'] =  '';
            $data['button_link'] =  '';
            $data['short_desc'] =  '';
            $data['status'] =  '';
            
            $data['id'] = 0;
        }
        return view('admin/banner/manage_banner', $data);
    }

    // function to add and edit category
    // adding or edditing will be decided based on the hidden ID that we have passed
    function manage_banner_process(Request $request)
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
            'button_text' => 'required',
            'button_link' => 'required',
            'short_desc' => 'required',
        
        ]);




        if ($id > 0) {
            $result = Banner::find($id);

            if($request->hasFile('image')) {
            $old_image = $result->image;
            $old_image_file = 'storage/media/banner' . '/' . $old_image;
            if (file_exists($old_image_file)) {
                unlink($old_image_file);
            }
        }
            $msg = "Banner Inserted Succesfull";
        } else {
            $result = new Banner();
            $msg = "Banner Updated Succesfull";
            $result->created_at = date('Y-m-d');
        }
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_file = time() . '.' . $ext;
            $image->storeAs('public/media/banner' . '/', $image_file);
            $result->image = $image_file;
        }
        $name = $request->post('name');
        $button_text = $request->post('button_text');
        $button_link = $request->post('button_link');
        $short_desc = $request->post('short_desc');
        $result->name = $name;
        $result->button_text = $button_text;
        $result->button_link = $button_link;
        $result->short_desc = $short_desc;
        $result->status = 1;
        $result->updated_at = date('Y-m-d');
        $result->save();
        session()->flash('msg', $msg);
        return redirect('admin/banner');
    }

    function delete($id)
    {
        $result = Banner::find($id);

        $image_name = $result->image;

        $image_file = 'storage/media/banner' . '/' . $image_name;
        if (file_exists($image_file)) {
            unlink($image_file);
        }
        $result->delete();
        session()->flash('msg', 'Banner Deleted Succesfull');
        return redirect('admin/banner');
    }

    function status(Request $request, $status, $id)
    {

        $result = Banner::find($id);
        $result->status = $status;
        $result->save();
        $request->session()->flash('msg', 'Status Updated succesfull');
        return redirect('admin/banner');
    }
}
