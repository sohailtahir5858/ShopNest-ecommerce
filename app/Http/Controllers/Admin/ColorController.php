<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $data['result'] = Color::all();


        return view('admin/color/color', $data);
    }

    function manage_color_action(Request $request, $id = '')
    {

        if ($id > 0) {
            // mean we got the ID and we ahve to edit it now. so we will get the data of this id and send it to the form
            $arr = Color::where(['id' => $id])->get();


            $data['color'] = $arr['0']->color;
            $data['id'] = $arr['0']->id;
        } else {
            // since we didn't get the ID, so we have to insert it. therefore we will return the insrt form


            $data['id'] = 0;
            $data['color'] = '';
        }
        return view('admin/color/manage_color', $data);
    }

    // function to add and edit category
    // adding or edditing will be decided based on the hidden ID that we have passed
    function manage_color_process(Request $request)
    {

        $id = $request->post('id');


        $request->validate([
            'color' => 'required|unique:colors,color,' . $id
        ]);


        $color = $request->post('color');


        if ($id > 0) {
            $result = Color::find($id);
            $msg = "color Inserted Succesfull";
        } else {
            $result = new Color();
            $msg = "color Updated Succesfull";
            $result->created_at = date('Y-m-d');
        }

        $result->color = $color;
        $result->status = 1;
        $result->updated_at = date('Y-m-d');
        $result->save();
        session()->flash('msg', $msg);
        return redirect('admin/color');
    }

    function delete($id)
    {
        $result = Color::find($id);
        $result->delete();
        session()->flash('msg', 'Clor Deleted Succesfull');
        return redirect('admin/color');
    }

    function status(Request $request, $status, $id)
    {

        $result = Color::find($id);
        $result->status = $status;
        $result->save();
        $request->session()->flash('msg', 'color Updated succesfull');
        return redirect('admin/color');
    }
}
