<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $data['result'] = Product::all();


        return view('admin/product/product', $data);
    }

    function manage_product_action(Request $request, $id = '')
    {
        // return "i am hit"; die();
        // getting data for all category to be placed in select


        if ($id > 0) {
            // mean we got the ID and we ahve to edit it now. so we will get the data of this id and send it to the form
            $arr = Product::where(['id' => $id])->get();

            // initializing all elements in the product_attr table in the resulting array so that we can return it. it will initialize it as a whole
            $data['productAttrArr'] = DB::table('product_attr')->where(['product_id' => $id])->get();

            /* Fetching data from product_images table*/
            $productImagesArr = DB::table('product_images')->where(['product_id' => $id])->get();

            // since it is not compulsory to have images in product_images table. if we are updation and still we dont have images so it will give an error. thus we will initialize it with null just to be on safe side
            if (isset($productImagesArr[0])) {
                $data['productImagesArr'] = $productImagesArr;
            } else {
                $data['productImagesArr'][0]['id'] = '';
                $data['productImagesArr'][0]['product_id'] = '';
                $data['productImagesArr'][0]['images'] = '';
            }



            $data['category_id'] = $arr['0']->category_id;
            $data['brand_id'] = $arr['0']->brand_id;
            $data['name'] = $arr['0']->name;
            $data['image'] = $arr['0']->image;
            $data['slug'] = $arr['0']->slug;
            $data['brand'] = $arr['0']->brand;
            $data['model'] = $arr['0']->model;
            $data['short_desc'] = $arr['0']->short_desc;
            $data['desc'] = $arr['0']->desc;
            $data['keywords'] = $arr['0']->keywords;
            $data['technical_specification'] = $arr['0']->technical_specification;
            $data['lead_time'] = $arr['0']->lead_time;
            $data['tax_id'] = $arr['0']->tax_id;
            $data['is_promo'] = $arr['0']->is_promo;
            $data['is_featured'] = $arr['0']->is_featured;
            $data['is_discounted'] = $arr['0']->is_discounted;
            $data['is_trending'] = $arr['0']->is_trending;
            $data['uses'] = $arr['0']->uses;
            $data['waranty'] = $arr['0']->waranty;
            $data['status'] = $arr['0']->status;

            $data['id'] = $arr['0']->id;
        } else {
            // since we didn't get the ID, so we have to insert it. therefore we will return the insrt form

            $data['category_id'] = '';
            $data['name'] = '';
            $data['image'] = '';
            $data['slug'] = '';
            $data['brand'] = '';
            $data['model'] = '';
            $data['short_desc'] = '';
            $data['desc'] = '';
            $data['keywords'] = '';
            $data['technical_specification'] = '';
            $data['lead_time'] = '';
            $data['tax_id'] = '';
            $data['is_promo'] = '';
            $data['is_featured'] = '';
            $data['is_discounted'] = '';
            $data['is_trending'] = '';
            $data['uses'] = '';
            $data['waranty'] = '';
            $data['status'] = '';
            $data['brand_id'] = '';

            // initializing theese to null when adding new items
            $data['productAttrArr'][0]['id'] = '';
            $data['productAttrArr'][0]['color_id'] = '';
            $data['productAttrArr'][0]['size_id'] = '';
            $data['productAttrArr'][0]['price'] = '';
            $data['productAttrArr'][0]['qty'] = '';
            $data['productAttrArr'][0]['mrp'] = '';
            $data['productAttrArr'][0]['product_id'] = '';
            $data['productAttrArr'][0]['sku'] = '';
            $data['productAttrArr'][0]['attr_image'] = '';
            $data['sku'] = '';
            $data['id'] = '';

            // initalizing following values to null if we are adding new
            $data['productImagesArr'][0]['id'] = '';
            $data['productImagesArr'][0]['product_id'] = '';
            $data['productImagesArr'][0]['images'] = '';
        }
        // echo '<pre>';
        // print_r($data['productAttrArr']);
        // die();

        // getting value from categories table for our categories dropdown
        $data['category'] = DB::table('categories')->where(['status' => 1])->get();

        // getting value from categories table for our categories dropdown
        $data['tax'] = DB::table('taxes')->where(['status' => 1])->get();

        // getting value from categories table for our categories dropdown
        $data['brand'] = DB::table('brands')->where(['status' => 1])->get();

        // getting value from colors table for our color dropdown
        $data['color'] = DB::table('colors')->get();

        // getting value from sizes table for our size dropdown
        $data['size'] = DB::table('sizes')->get();


        return view('admin/product/manage_product', $data);
    }



    /*
    function to add and edit category
     adding or edditing will be decided based on the hidden ID that we have passed */
    function manage_product_process(Request $request)
    {
        // echo '<pre>';
        // print_r($request->post());
        // die();
        $id = $request->post('id');

        if ($id > 0) {
            $validate = 'mimes:jpg,png,jpeg';
            $image_validation = $validate;
            $image_attr_validation = $validate;
            $product_image_validation = $validate;
        } else if ($id == 0) {
            $validate = 'required|mimes:jpg,png,jpeg';
            $image_validation = $validate;
            $image_attr_validation = $validate;
            $product_image_validation = 'required|mimes:jpg,png,jpeg';
        }

        $request->validate([
            'name' => 'required|unique:products,name,' . $id,
            'slug' => 'required|unique:products,slug,' . $id,
            'category' => 'required',
            'brand' => 'required',
            'tax_id' => 'required',
            'is_featured' => 'required',
            'is_discounted' => 'required',
            'is_promo' => 'required',
            'is_trending' => 'required',

            'sku.*' => 'required',
            'image' => $image_validation,
            'attr_image.*' => $image_attr_validation,
            'product_images.*' => $product_image_validation,
        ]);



        $name = $request->post('name');
        $category_id = $request->post('category');
        $brand_id = $request->post('brand');
        $slug = $request->post('slug');
        $brand = $request->post('brand');
        $model = $request->post('model');
        $short_desc = $request->post('short_desc');
        $desc = $request->post('desc');
        $keywords = $request->post('keywords');
        $technical_specification = $request->post('technical_specification');
        $lead_time = $request->post('lead_time');
        $tax_id = $request->post('tax_id');
        $is_promo = $request->post('is_promo');
        $is_featured = $request->post('is_featured');
        $is_discounted = $request->post('is_discounted');
        $is_trending = $request->post('is_trending');
        $uses = $request->post('uses');
        $waranty = $request->post('waranty');
        $status = 1;

        // ------------Product Attr Table Values are below
        $skuArr = $request->post('sku');
        $color_idArr = $request->post('color');
        $size_idArr = $request->post('size');
        $qtyArr = $request->post('qty');
        $priceArr = $request->post('price');
        $mrpArr = $request->post('mrp');
        $paidArr = $request->post('paid');
        // ------------End of Product Attr Values



        /*  --start of sku validation in product attr table
            Checking and validation to have unique SKU value in our product_attr table.
            ->we can do it in two ways. 1 is to use the build in and other is to create our own validation. lets see both

            =>we basically have to check evey sku value in data if we found id in anywhere. we will redirect it from where we actually came
        */


        foreach ($skuArr as $key => $val) {
            $check = DB::table('product_attr')->where('sku', '=', $skuArr[$key])->where('id', '!=', $paidArr[$key])->get();

            if (isset($check[0])) {
                $request->session()->flash('msg', 'Entered SKU => ' . $skuArr[$key] . ' <= Already Exists. Please Try another');

                // following line of code will redirect us to the page/location fom where we actually came
                return redirect(request()->headers->get('referer'));
            }
        }
        /* --End of sku validation in product attr table
        */


        // if id>0 then we have to do updation else we have to insert
        if ($id > 0) {

            $result = Product::find($id);
            $msg = "product Inserted Succesfull";

            // if user want to add/change image during updation
            if ($request->hasFile('image')) {
                $old_image = $result->image;

                $image = $request->file('image');
                $ext = $image->extension();
                $image_file = time() . '.' . $ext;
                $result->image = $image_file;
                $image->storeAs('public/media/product/', $image_file);

                $old_image_path = 'storage/media/product/' . '/' . $old_image;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
        } else { //mean we have to do insert here

            $result = new Product();

            $msg = "product Updated Succesfull";
            $result->created_at = date('Y-m-d');

            // if user wants to add image as a new
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $ext = $image->extension();
                $image_file = time() . '.' . $ext;
                $result->image = $image_file;
                $image->storeAs('public/media/product/', $image_file);
            }
        }
        $result->name = $name;
        $result->slug = $slug;
        $result->category_id = $category_id;
        $result->brand_id = $brand_id;
        $result->brand = $brand;
        $result->model = $model;
        $result->short_desc = $short_desc;
        $result->desc = $desc;
        $result->keywords = $keywords;
        $result->technical_specification = $technical_specification;
        $result->lead_time = $lead_time;
        $result->tax_id = $tax_id;
        $result->is_promo = $is_promo;
        $result->is_featured = $is_featured;
        $result->is_discounted = $is_discounted;
        $result->is_trending = $is_trending;
        $result->uses = $uses;
        $result->waranty = $waranty;
        $result->status = 1;
        $result->updated_at = date('Y-m-d');
        $result->save();

        // since we need new product id after insertino of this product so we will get it once it is saved
        $pid = $result->id;

        // product Attr section start       -------Product Attr section------



        // since sku is must and we will be getting it anyway so we will
        // loop through sku and add all items that are selected. those wich are nor required will be left as blank 
        foreach ($skuArr as $key => $val) {

            $productAttrArr['product_id'] = $pid;
            $productAttrArr['size_id'] = $size_idArr[$key];
            $productAttrArr['price'] = $priceArr[$key];

            $productAttrArr['qty'] = $qtyArr[$key];
            $productAttrArr['mrp'] = $mrpArr[$key];
            $productAttrArr['sku'] = $skuArr[$key];


            // since these are not required so if user has not selected them we will upload them as null
            if ($color_idArr[$key] == '') {
                $productAttrArr['color_id'] = 0;
            } else {
                $productAttrArr['color_id'] = $color_idArr[$key];
            }

            if ($size_idArr[$key] == '') {
                $productAttrArr['size_id'] = 0;
            } else {
                $productAttrArr['size_id'] = $size_idArr[$key];
            }

            /*
                Image section to be uploaded and deleted if already exist
            */
            if ($request->hasfile('attr_image.' . $key)) {

                // if we have product_attr table id and we also have an image related to it. it means we are updating that image, so we will try to delete the old image and upload the new image. lets see
                if ($paidArr[$key] != '') {
                    $image_attr_result = DB::table('product_attr')->where(['id' => $paidArr[$key]])->get();

                    // $image_attr_result = (array)$image_attr_result;
                    $old_attr_image =  $image_attr_result[0]->attr_image;

                    $old_attr_image_path = 'storage/media/product/' . '/' . $old_attr_image;

                    if (file_exists($old_attr_image_path)) {
                        unlink($old_attr_image_path);
                    }
                }
                $image_attr = $request->file('attr_image.' . $key);
                $ext = $image_attr->extension();
                $rand_nam = rand(11111, 99999);
                $image_attr_file = $rand_nam . '.' . $ext;
                $request->file('attr_image.' . $key)->storeAs('public/media/product/', $image_attr_file);
                $productAttrArr['attr_image'] = $image_attr_file;
            }

            /*
                here we are checking if we have any data in the current ID(KEY) of product_attr table for which we are using the foreach loop. so if we ave an id. it means we ave to update the current data based on the id. if we dont have an id(else condition). then we basically need to insert a fresh new record 
            */
            if ($paidArr[$key] != '') {
                $msg = "product Updated Succesfull";
                DB::table('product_attr')->where(['id' => $paidArr[$key]])->update($productAttrArr);
            } else {
                DB::table('product_attr')->insert($productAttrArr);
            }
        } //End of foreach loop for product_attr table section --


        /*  --Product Images values are below */
        /*  --piiArr is the array of product ID */
        /* --End of product Images  */
        /* Product Images secion */
        $piidArr = $request->post('piid');
        foreach ($piidArr as $key => $val) {



            /* Image section to be uploaded and deleted if already       exist*/
            if ($request->hasfile('product_images.' . $key)) {

                // if we have product_attr table id and we also have an image related to it. it means we are updating that image, so we will try to delete the old image and upload the new image. lets see
                if ($piidArr[$key] != '') {
                    $product_images_result = DB::table('product_images')->where(['id' => $piidArr[$key]])->get();

                    // product_images_result = (array)$image_attr_result;
                    $old_product_image =  $product_images_result[0]->images;

                    $old_product_image_path = 'storage/media/product/' . '/' . $old_product_image;

                    if (file_exists($old_product_image_path)) {
                        unlink($old_product_image_path);
                    }
                }
                $product_images = $request->file('product_images.' . $key);
                $ext = $product_images->extension();
                $rand_nam = rand(11111, 99999);
                $product_image_file = $rand_nam . '.' . $ext;
                $request->file('product_images.' . $key)->storeAs('public/media/product/', $product_image_file);

                $productImagesArr['product_id'] = $pid;
                $productImagesArr['images'] = $product_image_file;

                if ($piidArr[$key] != '') {
                    $msg = "product Updated Succesfull";
                    DB::table('product_images')->where(['id' => $piidArr[$key]])->update($productImagesArr);
                } else {
                    DB::table('product_images')->insert($productImagesArr);
                }
            }

            /*
                here we are checking if we have any data in the current ID(KEY) of product_attr table for which we are using the foreach loop. so if we ave an id. it means we ave to update the current data based on the id. if we dont have an id(else condition). then we basically need to insert a fresh new record 
            */
        }

        /* End of product images section */
        session()->flash('msg', $msg);
        return redirect('admin/product');
    }






    function delete_product_images(Request $request, $piid, $pid)
    {
        // return "delete is hit";
        // die();
        $result = DB::table('product_images')->where(['id' => $piid])->get();


        // $image_attr_result = (array)$image_attr_result;
        $old_attr_image =  $result[0]->images;

        $old_attr_image_path = 'storage/media/product/' . '/' . $old_attr_image;

        if (file_exists($old_attr_image_path)) {
            unlink($old_attr_image_path);
        }

        DB::table('product_attr')->where(['id' => $piid])->delete();
        return redirect('admin/product/edit' . '/' . $pid);
    }


    function delete_product_attr(Request $request, $paid, $pid)
    {
        // return "delete is hit";
        // die();
        $result = DB::table('product_attr')->where(['id' => $paid])->get();


        // $image_attr_result = (array)$image_attr_result;
        $old_attr_image =  $result[0]->attr_image;

        $old_attr_image_path = 'storage/media/product/' . '/' . $old_attr_image;

        if (file_exists($old_attr_image_path)) {
            unlink($old_attr_image_path);
        }

        DB::table('product_attr')->where(['id' => $paid])->delete();
        return redirect('admin/product/edit' . '/' . $pid);
    }


    function delete($id)
    {



        $result = Product::find($id);

        // deleting the single image that is in product table
        $old_image = $result->image;
        $old_image_path = 'storage/media/product/' . '/' . $old_image;
        if (file_exists($old_image_path)) {
            unlink($old_image_path);
        }



        // deleting the multiple images that are in product_attr table
        $result_product_attr = DB::table('product_attr')->where(['product_id' => $id])->get();


        foreach ($result_product_attr as $key => $val) {
            // $product_attr_result = (array)$product_attr_result;
            $old_attr_image =  $result_product_attr[$key]->attr_image;
            $old_attr_image_path = 'storage/media/product/' . '/' . $old_attr_image;

            if (file_exists($old_attr_image_path)) {
                unlink($old_attr_image_path);
            }
        }





        /* deleting images from product_images table and as well as from media folder*/

        $temp = '';
        $result_product_images = DB::table('product_images')->where(['product_id' => $id])->get();
        foreach ($result_product_images as $key => $val) {
            $old_product_image =  $result_product_images[$key]->images;
            $old_product_image_path = 'storage/media/product/' . '/' . $old_product_image;
            if (file_exists($old_product_image_path)) {
                unlink($old_product_image_path);
            }
        }

        DB::table('product_images')->where(['product_id' => $id])->delete();

        DB::table('product_attr')->where(['product_id' => $id])->delete();


        $result->delete();
        session()->flash('msg', 'product Deleted Succesfull');
        return redirect('admin/product');
    }

    function status(Request $request, $status, $id)
    {

        $result = Product::find($id);
        $result->status = $status;
        $result->save();
        $request->session()->flash('msg', 'Status Updated succesfull');
        return redirect('admin/product');
    }
}
