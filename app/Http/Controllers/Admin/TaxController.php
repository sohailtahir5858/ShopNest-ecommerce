<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $data['result'] = Tax::all();


        return view('admin/tax/tax', $data);
    }

    function manage_tax_action(Request $request, $id = '')
    {

        if ($id > 0) {
            // mean we got the ID and we ahve to edit it now. so we will get the data of this id and send it to the form
            $arr = Tax::where(['id' => $id])->get();


            $data['tax_desc'] = $arr['0']->tax_desc;
            $data['value'] = $arr['0']->value;
            $data['id'] = $arr['0']->id;
        } else {
            // since we didn't get the ID, so we have to insert it. therefore we will return the insrt form


            $data['id'] = 0;
            $data['tax_desc'] = '';
            $data['value'] = '';
        }
        return view('admin/tax/manage_tax', $data);
    }

    // function to add and edit category
    // adding or edditing will be decided based on the hidden ID that we have passed
    function manage_tax_process(Request $request)
    {

        $id = $request->post('id');


        $request->validate([
            'tax_desc' => 'required',
            'value' => 'required',
        ]);


        $tax_desc = $request->post('tax_desc');
        $value = $request->post('value');


        if ($id > 0) {
            $result = Tax::find($id);
            $msg = "tax Inserted Succesfull";
        } else {
            $result = new Tax();
            $msg = "tax Updated Succesfull";
            $result->created_at = date('Y-m-d');
        }

        $result->tax_desc = $tax_desc;
        $result->value = $value;
        $result->status = 1;
        $result->updated_at = date('Y-m-d');
        $result->save();
        session()->flash('msg', $msg);
        return redirect('admin/tax');
    }

    function delete($id)
    {
        $result = Tax::find($id);
        $result->delete();
        session()->flash('msg', 'Tax Deleted Succesfull');
        return redirect('admin/tax');
    }

    function status(Request $request, $status, $id)
    {

        $result = Tax::find($id);
        $result->status = $status;
        $result->save();
        $request->session()->flash('msg', 'Tax Updated succesfull');
        return redirect('admin/tax');
    }
}
