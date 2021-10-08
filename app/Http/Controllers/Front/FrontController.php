<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// we will use Hash to encript our password

class FrontController extends Controller
{

    public function index()
    {

        /* Getting data of banners from banner table */

        $result['banners'] = DB::table('banners')->where(['status' => 1])->take(6)->get();

        /* Getting data from category table and returning it back to index page */
        $result['home_categories'] = DB::table('categories')->where(['status' => 1])->where(['is_home' => 1])->get();


        $result['home_brands'] = DB::table('brands')->where(['status' => '1', 'is_home' => '1'])->get();



        // -------------------Print Category Information
        /* echo '<pre>';
        print_r($result['home_categories']);
        die(); */
        foreach ($result['home_categories'] as $list) {


            // -------Get Each product Based on the Category ID that we already have in each loop. so whereever in products, the category ID matches the on that is currently in loop (of category loop) so we will get that product.
            $result['home_categories_product'][$list->id] = DB::table('products')
                ->where(['category_id' => $list->id])
                ->where(['status' => 1])
                ->take(6)
                ->get();



            // -----------------------To display all the products that are in this category id
            // echo '<pre>';
            // print_r($result['home_categories_product']);
            // die();

            // Now since we have products which means product id. so we need to get all the product attribute rows based on this product id. in this loop. id changes each time, so based on every product_id, we will run a loop through product_attr table and check if we have any product_attr data related to this product

            //$list->id is category id
            //$attr_list->id is product id 

            if (isset($list->id)) {
                foreach ($result['home_categories_product'][$list->id] as $attr_list) {
                    $result['home_product_attr'][$attr_list->id] =

                        DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.id' => $attr_list->id])->get();



                    $result['home_product_images'][$attr_list->id] =
                        DB::table('product_images')->where(['product_id' => $attr_list->id])->get();



                    // ---------if we want to show product_attr based on each product id in this loop
                    // echo '<pre>';
                    // print_r($result['home_product_attr']);
                    // die();


                    // now since we have product_attr id of a particular roduct, we will check and get the size and color from the table seperate tables by creating a left join



                    // echo '<pre>';
                    // print_r($result['home_product_attr']);
                    // die();
                }
            }


            // Start-------------------------Taking data for is_featured

            $result['home_featured_product'][$list->id] = DB::table('products')
                ->where(['is_featured' => 1])
                ->where(['status' => 1])
                ->take(6)
                ->get();

            // echo '<pre>';
            // print_r($result['home_featured_product']);
            // die();
            foreach ($result['home_featured_product'][$list->id] as $featured_list) {
                $result['home_feature_product_attr'][$featured_list->id] =

                    DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.id' => $featured_list->id])->get();
            }
            // End-------------------------Taking data for is_featured




            // Start-------------------------Taking data for is_discounted
            $result['home_discounted_product'][$list->id] = DB::table('products')
                ->where(['is_discounted' => 1])
                ->where(['status' => 1])
                ->take(6)
                ->get();

            foreach ($result['home_discounted_product'][$list->id] as $discounted_list) {
                $result['home_discounted_product_attr'][$discounted_list->id] =

                    DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.id' => $discounted_list->id])->get();
            }
            // End-------------------------Taking data for discounted


            // Start-------------------------Taking data for is_discounted
            $result['home_trending_product'][$list->id] = DB::table('products')
                ->where(['is_trending' => 1])
                ->where(['status' => 1])
                ->take(6)
                ->get();
            foreach ($result['home_trending_product'][$list->id] as $trending_list) {
                $result['home_trending_product_attr'][$trending_list->id] =

                    DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.id' => $trending_list->id])->get();
            }
            // End-------------------------Taking data for trending

        }
        // echo '<pre>';
        // print_r($result);
        // die();

        return view('front/index', $result);
    }

    public function product($slug)
    {


        $result['product'] = DB::table('products')->where(['slug' => $slug])->where(['status' => '1'])->get();

        foreach ($result['product'] as $list) {
            $result['product_attr'] =

                DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $list->id])->get();
        }

        foreach ($result['product'] as $list) {
            $result['product_images'] = DB::table('product_images')->where(['product_id' => $list->id])->get();
        }




        $pid = $result['product'][0]->category_id;
        $result['related_product'] = DB::table('products')->where(['category_id' => $pid])->where(['status' => '1'])->where('slug', '!=', $slug)->get();

        foreach ($result['related_product'] as $list) {
            $result['related_product_attr'] =

                DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $list->id])->get();

            $result['related_product_images'] = DB::table('product_images')->where(['product_id' => $list->id])->get();
        }
        //         prx($result['product']);
        //         prx($result['product_attr']);
        //         prx($result['product_images']);


        //  prx($result['related_product']);
        //  die(); 

        // prx($result);
        // die();

        return view('front/product', $result);
    }


    /* add to cart */
    function add_to_cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $userid = $request->session()->get('FRONT_USER_ID');
            $userTpe = 'reg';
        } else {
            $userid = getUserTempId();
            $userTpe = 'non-reg';
        }

        $size_id = $request->post('size_val-id');
        $color_id = $request->post('color_val_id');

        $qty = $request->post('qty');
        $product_id = $request->post('product_id');

        // return ''.$size_id.'  '. $color_id.' '.  $qty . ' ' . $product_id;die();
        // prx("table('product_attr')
        // ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $product_id])->where(['sizes.size' => $size_id])->where(['colors.color' => $color_id])->get();");die();
        // now we have to get its product attr id
        $result = DB::table('product_attr')
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $product_id])->where(['sizes.size' => $size_id])->where(['colors.color' => $color_id])->get();
         $product_attr_id = $result[0]->id;
        
        /* Now we have all the data */
        /* but we have to check if we have to add data to cart or we have to update exsting data in the cart */
        $checkIfExist = DB::table('cart')
            ->where(['user_id' => $userid])
            ->where(['user_type' => $userTpe])
            ->where(['product_id' => $product_id])
            ->where(['product_attr_id' => $product_attr_id])->get();


        if (isset($checkIfExist[0])) {
            $update_id = $checkIfExist[0]->id;
            /* Mean we have to delete the qty */
            if($qty == 0){
                DB::table('cart')->where(['id' => $update_id])->delete();
                $msg = "Deleted";
            }
            /* Mean we have to update the qty */
            else{
                DB::table('cart')->where(['id' => $update_id])->update(['qty' => $qty]);
                $msg = "Updated";
            }
            
        } else {
            $new_id = DB::table('cart')->insertGetId([
                'user_id' => $userid,
                'user_type' => $userTpe,
                'qty' => $qty,
                'product_id' => $product_id,
                'product_attr_id' => $product_attr_id,
                'added_on' => date('Y-m-d'),
            ]);
            $msg = "Data added";
        }

        $cartResult = DB::table('cart')
        ->leftJoin('products', 'products.id', '=', 'cart.product_id')
        ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
        ->where(['user_id' => $userid])->select('cart.qty', 'products.name', 'products.slug', 'products.image', 'cart.id as cart_id', 'products.id as pid', 'product_attr.id as attr_id', 'product_attr.price', 'sizes.size', 'colors.color')->get();
        return response()->json(['msg' => $msg,'cartResult' => $cartResult,'cartTotalCount' => count($cartResult)]);
    }


    function cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $userid = $request->session()->get('FRONT_USER_ID');
            $userTpe = 'reg';
        } else {
            $userid = getUserTempId();
            $userTpe = 'non-reg';
        }
        $result['cartData'] = DB::table('cart')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->where(['user_id' => $userid])->select('cart.qty', 'products.name', 'products.slug', 'products.image', 'cart.id as cart_id', 'products.id as pid', 'product_attr.id as attr_id', 'product_attr.price', 'sizes.size', 'colors.color')->get();
        // prx($result);
        // die();
        return view('front/cart', $result);
    }
}
