<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $data['result'] = Size::all();


        return view('admin/size/size', $data);
    }

    function manage_size_action(Request $request, $id = '')
    {

        if ($id > 0) {
            // mean we got the ID and we ahve to edit it now. so we will get the data of this id and send it to the form
            $arr = Size::where(['id' => $id])->get();

          
            $data['size'] = $arr['0']->size;
            $data['id'] = $arr['0']->id;
        } else {
            // since we didn't get the ID, so we have to insert it. therefore we will return the insrt form

            
            $data['id'] = 0;
            $data['size'] = '';
        }
        return view('admin/size/manage_size', $data);
    }

    // function to add and edit category
    // adding or edditing will be decided based on the hidden ID that we have passed
    function manage_size_process(Request $request)
    {

        $id = $request->post('id');


        $request->validate([
     'size' => 'required|unique:sizes,size,'.$id
        ]);

        
        $size = $request->post('size');


        if ($id > 0) {
            $result = Size::find($id);
            $msg = "size Inserted Succesfull";
        } else {
            $result = new Size();
            $msg = "size Updated Succesfull";
            $result->created_at = date('Y-m-d');
        }
        
        $result->size = $size;
        $result->status = 1;
        $result->updated_at = date('Y-m-d');
        $result->save();
        session()->flash('msg', $msg);
        return redirect('admin/size');
    }

    function delete($id)
    {
        $result = Size::find($id);
        $result->delete();
        session()->flash('msg', 'Size Deleted Succesfull');
        return redirect('admin/size');
    }

    function status(Request $request,$status, $id){
        
        $result = Size::find($id);
        $result->status = $status;
        $result->save();
       $request->session()->flash('msg','Size Updated succesfull');
        return redirect('admin/size');
    }
}
