<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        $data['result'] = Category::all();


        return view('admin/category/category', $data);
    }

    function manage_category_action(Request $request, $id = '')
    {

        if ($id > 0 && $id != '') {
            // mean we got the ID and we ahve to edit it now. so we will get the data of this id and send it to the form
            $arr = Category::where(['id' => $id])->get();

            $data['category_name'] = $arr['0']->category_name;
            $data['category_slug'] = $arr['0']->category_slug;
            $data['id'] = $arr['0']->id;
            $data['is_home'] = $arr['0']->is_home;
            $data['parent_category_id'] = $arr['0']->parent_category_id;
            $data['image'] = $arr['0']->image;
            $data['categories'] = DB::table('categories')->where(['status' => 1])->where('id', '!=', $id)->get();
        } else {
            // since we didn't get the ID, so we have to insert it. therefore we will return the insrt form

            $data['category_name'] = '';
            $data['id'] = 0;
            $data['category_slug'] = '';
            $data['parent_category_id'] = '';
            $data['image'] = '';
            $data['is_home'] = '';
            $data['categories'] = DB::table('categories')->where(['status' => 1])->get();
        }

        return view('admin/category/manage_category', $data);
    }

    // function to add and edit category
    // adding or edditing will be decided based on the hidden ID that we have passed
    function manage_category_process(Request $request)
    {

        $id = $request->post('id');

        if ($id > 0) {
            $image_validate = 'mimes:jpg,png,jpeg';
        } else {
            $image_validate = 'required|mimes:jpg,png,jpeg';
        }
        $request->validate([
            'category' => 'required|unique:categories,category_name,' . $id,
            'slug' => 'required|unique:categories,category_slug,' . $id,
            'image' => $image_validate,
            'is_home' => 'required',
        ]);

        $category_name = $request->post('category');
        $slug = $request->post('slug');
        $is_home = $request->post('is_home');
        $parent_category_id = $request->post('parent_category_id');


        if ($id > 0) {
            $result = Category::find($id);

            if ($request->hasFile('image')) {
                $old_image  = $result->image;

                $old_image_path = 'storage/media/category' . '/' . $old_image;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
            $msg = "Category Inserted Succesfull";
        } else {
            $result = new Category();



            $msg = "Category Updated Succesfull";
            $result->created_at = date('Y-m-d');
        }

        if ($request->hasFile('image')) {
            $image  = $request->file('image');
            $ext = $image->extension();
            $rand = rand(11111, 99999);
            $image_file = $rand . '.' . $ext;
            $image->storeAs('public/media/category/', $image_file);
            $result->image = $image_file;
        }
        $result->category_name = $category_name;
        $result->category_slug = $slug;
        $result->is_home = $is_home;
        if($parent_category_id == ''){
        $result->parent_category_id = 0;
        }else{
        $result->parent_category_id = $parent_category_id;
        }
        $result->status = 1;
        $result->updated_at = date('Y-m-d');
        $result->save();
        session()->flash('msg', $msg);
        return redirect('admin/category');
    }

    function delete($id)
    {
        $result = Category::find($id);

        $old_image  = $result->image;
        $old_image_path = 'storage/media/category' . '/' . $old_image;
        if (file_exists($old_image_path)) {
            unlink($old_image_path);
        }
        $result->delete();
        session()->flash('msg', 'Category Deleted Succesfull');
        return redirect('admin/category');
    }

    function status(Request $request, $status, $id)
    {

        $result = Category::find($id);
        $result->status = $status;
        $result->save();
        $request->session()->flash('msg', 'Status Updated succesfull');
        return redirect('admin/category');
    }
}
