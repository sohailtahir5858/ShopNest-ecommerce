<?php

use Illuminate\Support\Facades\DB;

function prx($data)
{
    echo '<pre>';
    print_r($data);
}
function getTopNavCat()
{
    $result = DB::table('categories')
        ->where(['status' => 1])
        ->get();
    $arr = [];
    foreach ($result as $row) {
        $arr[$row->id]['city'] = $row->category_name;
        $arr[$row->id]['parent_id'] = $row->parent_category_id;
    }
    $str = buildTreeView($arr, 0);
    return $str;
}
$html = '';
function buildTreeView($arr, $parent, $level = 0, $prelevel = -1)
{
    global $html;
    foreach ($arr as $id => $data) {
        if ($parent == $data['parent_id']) {
            if ($level > $prelevel) {
                if ($html == '') {
                    $html .= '<ul class="nav navbar-nav">';
                } else {
                    $html .= '<ul class="dropdown-menu">';
                }
            }
            if ($level == $prelevel) {
                $html .= '</li>';
            }
            $html .= '<li><a href="#">' . $data['city'] . '<span class="caret"></span></a>';
            if ($level > $prelevel) {
                $prelevel = $level;
            }
            $level++;
            buildTreeView($arr, $id, $level, $prelevel);
            $level--;
        }
    }
    if ($level == $prelevel) {
        $html .= '</li></ul>';
    }
    return $html;
}
function getUserTempId(){
        
    if(!(session()->has('USER_TEMP_ID'))){
        $rand= rand(111111,999999);
        session()->put('USER_TEMP_ID',$rand);
        return $rand;
    }else{
        return session()->get('USER_TEMP_ID');
    }
}

function getAddToCartTotalItem(){
        
    if (session()->has('FRONT_USER_LOGIN')) {
        $userid = session()->get('FRONT_USER_ID');
        $userTpe = 'reg';
    } else {
        $userid = getUserTempId();
        $userTpe = 'non-reg';
    }

    $result= DB::table('cart')
    ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->where(['user_id' => $userid])->select('cart.qty', 'products.name', 'products.slug', 'products.image', 'cart.id as cart_id', 'products.id as pid', 'product_attr.id as attr_id', 'product_attr.price', 'sizes.size', 'colors.color')->get();
    
 
    return $result;
}
