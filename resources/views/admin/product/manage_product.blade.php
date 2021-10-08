@extends('admin.layout.layout');
@section('product_select', 'active')
@section('page_title', 'Manage Product')

@section('container')
    {{-- CKEDiter JS --}}
    <script src="{{ asset('ckeditor/styles.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <h3 class="mb-3">Manage Product</h3>
        <a href="{{ url('admin/product') }}">
            <button type="button" class="btn mb-3 btn-success btn-lg ">Back</button>
        </a>

        @if (session()->has('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @error('attr_image.*')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @enderror()
        <form action="{{ route('manage_product_process') }} " method="post" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <div class="card mb-0">
                <div class="card-header">Credit Card</div>
                <div class="card-body">



                    <div class="row">
                        <div class="form-group col-md-4 com-lg-4">
                            <label for="name" class="control-label mb-1">Product Name</label>
                            <input id="name" name="name" type="text" class="form-control" required aria-required="true"
                                aria-invalid="false" value="{{ $name }} ">
                            <span style="color:red">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group col-md-4 com-lg-4">
                            <label for="slug" class="control-label mb-1">Slug</label>
                            <input id="slug" required name="slug" type="text" class="form-control"
                                value="{{ $slug }} ">
                            <span style="color:red">
                                @error('slug')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{-- model --}}
                        <div class="form-group col-md-4 com-lg-4">
                            <label for="model" class="control-label mb-1">Model</label>
                            <input id="model" required name="model" type="text" class="form-control"
                                value="{{ $model }} ">
                            <span style="color:red">
                                @error('model')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-4 com-lg-4">
                            <label for="category" class="control-label mb-1">Select Categories</label>

                            <select class="form-control" id="category" name="category">
                                <option value="">Please select Category</option>
                                @foreach ($category as $item)
                                    @if ($item->id == $category_id)
                                        <option selected value="{{ $item->id }} ">{{ $item->category_name }}
                                        </option>
                                    @else
                                        <option value="{{ $item->id }} ">{{ $item->category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span style="color:red">
                                @error('category')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{-- Bond --}}
                        <div class="form-group col-md-4 com-lg-4">
                            <label for="brand" class="control-label mb-1">Select Brand</label>

                            <select class="form-control" id="brand" name="brand">
                                <option value="">Please select brand</option>
                                @foreach ($brand as $item)
                                    @if ($item->id == $brand_id)
                                        <option selected value="{{ $item->id }} ">{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }} ">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span style="color:red">
                                @error('category')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{-- Tax --}}
                        <div class="form-group col-md-4 com-lg-4">
                            <label for="category" class="control-label mb-1">Select Tax</label>

                            <select class="form-control" id="tax_id" name="tax_id">
                                <option value="">Please select Tax</option>
                                @foreach ($tax as $item)
                                    @if ($item->id == $tax_id)
                                        <option selected value="{{ $item->id }} ">{{ $item->tax_desc }}
                                        </option>
                                    @else
                                        <option value="{{ $item->id }} ">{{ $item->tax_desc }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span style="color:red">
                                @error('tax_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>



                    <div class="row">
                        {{-- Image --}}
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="image" class="control-label mb-1">Image</label>
                            <input type="file" id="image" name="image" class="form-control">

                            @if ($image != '')
                                <img class="form-control" style="width:10%"
                                    src="{{ asset('storage/media/product/') . '/' . $image }}" alt="Image not found">
                            @endif

                            <span style="color:red">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{-- Lead Time --}}
                        <div class="form-group col-md-6 com-lg-6">
                            <label for="lead_time" class="control-label mb-1">Lead Time</label>
                            <input id="lead_time" name="lead_time" type="text" class="form-control" required
                                value="{{ $lead_time }} ">
                            <span style="color:red">
                                @error('lead_time')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>


                    {{-- Short Desc --}}
                    <div class="form-group">
                        <label for="short_desc" class="control-label mb-1">Short Descrion</label>


                        <textarea name="short_desc" class="form-control" id="short_desc" cols="30"
                            rows="2">{{ $short_desc }}</textarea>
                        <span style="color:red">
                            @error('short_desc')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- Desc --}}
                    <div class="form-group">
                        <label for="desc" class="control-label mb-1">Description</label>
                        <textarea name="desc" class="form-control" id="desc" cols="30"
                            rows="3">{{ $desc }}</textarea>
                        <span style="color:red">
                            @error('desc')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- Technical Specification --}}
                    <div class="form-group">
                        <label for="technical_specification" class="control-label mb-1">Technical Specification</label>
                        <textarea id="technical_specification" required name="technical_specification" type="text"
                            class="form-control">{{ $technical_specification }} </textarea>
                        <span style="color:red">
                            @error('technical_specification')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- Keywords --}}
                    <div class="form-group">
                        <label for="keywords" class="control-label mb-1">Keywords</label>
                        <input id="keywords" required name="keywords" type="text" class="form-control"
                            aria-required="true" aria-invalid="false" value="{{ $keywords }} ">
                        <span style="color:red">
                            @error('keywords')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- Uses --}}
                    <div class="form-group">
                        <label for="uses" class="control-label mb-1">Uses</label>
                        <input id="uses" required name="uses" type="text" class="form-control" aria-required="true"
                            aria-invalid="false" value="{{ $uses }} ">
                        <span style="color:red">
                            @error('uses')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- Waranty --}}
                    <div class="form-group">
                        <label for="waranty" class="control-label mb-1">Waranty</label>
                        <input id="waranty" name="waranty" type="text" class="form-control" required
                            value="{{ $waranty }} ">
                        <span style="color:red">
                            @error('waranty')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- this row contains leadtime, tax and tax type --}}


                    {{-- this row contains is_discount,is_featured,and two more --}}
                    <div class="row">

                        {{-- Is promo --}}
                        <div class="form-group col-md-3 com-lg-3">
                            <label for="is_promo" class="control-label mb-1">Is Promo</label>
                            <select class="form-control" id="is_promo" name="is_promo">
                                <option value="">Select</option>
                                @if ($is_promo == '1')
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                @elseif ($is_promo == '0')
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                @else
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                @endif
                            </select>
                            <span style="color:red">
                                @error('is_promo')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{-- Is featured --}}
                        <div class="form-group col-md-3 com-lg-3">
                            <label for="is_featured" class="control-label mb-1">Is Featured</label>
                            <select class="form-control" id="is_featured" name="is_featured">
                                <option value="">Select</option>
                                @if ($is_featured == '1')
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                @elseif ($is_featured == '0')
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                @else
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                @endif
                            </select>
                            <span style="color:red">
                                @error('is_featured')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{-- is DIscounted --}}
                        <div class="form-group col-md-3 com-lg-3">
                            <label for="is_discounted" class="control-label mb-1">Is Discounted</label>
                            <select class="form-control" id="is_discounted" name="is_discounted">
                                <option value="">Select</option>
                                @if ($is_discounted == '1')
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                @elseif ($is_discounted == '0')
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                @else
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                @endif
                            </select>
                            <span style="color:red">
                                @error('is_discounted')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{-- is Trending --}}
                        <div class="form-group col-md-3 com-lg-3">
                            <label for="is_trending" class="control-label mb-1">Is Trending</label>
                            <select class="form-control" id="is_trending" name="is_trending">
                                <option value="">Select</option>
                                @if ($is_trending == '1')
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                @elseif ($is_trending == '0')
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                @else
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                @endif
                            </select>
                            <span style="color:red">
                                @error('is_trending')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>

                </div> 
            </div>



            <div id="product_images_box">

                {{-- this counter variable is bery important. it will give us the ID of blocks that we will be adding or removing. we will increment this through every loop --}}
                @php
                    $images_loop_count = 1000;
                    
                @endphp

                @foreach ($productImagesArr as $key => $val)

                    {{-- Typecasting object into array --}}
                    @php
                        $pIArr = (array) $val;
                        $images_loop_count_prev = $images_loop_count;
                    @endphp


                    <div class="card mt-3" id="product_images_{{ $images_loop_count++ }}">
                        <div class="card-header">Product Images</div>
                        <div class="card-body">

                            @if ($pIArr['images'] == '')
                                @php
                                    $required_images = 'required';
                                @endphp
                            @else
                                @php
                                    $required_images = '';
                                @endphp
                            @endif

                            <div class="row">
                                {{-- Image --}}
                                <div class="form-group col-md-8 col-lg-8">
                                    <label for="" class="control-label mb-1">Product Images</label>
                                    <input type="file" {{ $required_images }} id="images" name="product_images[]"
                                        class="form-control">

                                    @if ($pIArr['images'] != '')
                                        <a terget="_blank"
                                            href="{{ asset('storage/media/product') . '/' . $pIArr['images'] }}">

                                            <img class="form-control" style="width:20%"
                                                src=" {{ asset('storage/media/product') . '/' . $pIArr['images'] }} "
                                                alt="Not Found">
                                        </a>

                                    @endif
                                    <span style="color:red">
                                        @error('product_images.*')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>





                                {{-- here if counter is 2 or greater then it means we are editing because 2 is the first box since we increment it when we come accross it. so if 2 then add button otherwise remove button --}}
                                <div class="form-group col-md-3 com-lg-3">

                                    @if ($images_loop_count == 1001)
                                        <label for="sku" class="control-label mb-1">Add Button <br></label>

                                        <button type="button" style="font-size:17px" onclick="add_more_images()"
                                            class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount"><i class="fa fa-plus"></i>&nbsp; Add</span>
                                        </button>
                                    @else
                                        {{-- here we have to delete the row. we can do it in two ways. either through ajax or through page reload. lets do it on page reload. we are passing two IDs,
                                        1) on is forst product_attr id
                                        2) second one is the current product id on which all the data is being retrieved and filled in boxes --}}
                                        <label for="sku" class="control-label mb-1">Remove Button <br></label>

                                        <a
                                            href="{{ url('admin/product/product_images_delete/' . $pIArr['id'] . '/' . $id) }} ">

                                            <button style="font-size:17px" type="button"
                                                class="btn btn-lg btn-warning btn-block">
                                                <span id="payment-button-amount"><i class="fa fa-plus"></i>&nbsp;
                                                    Remove</span>
                                            </button></a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="piid" name="piid[]" value="{{ $pIArr['id'] }}">

                @endforeach
            </div>


            {{-- here when we are edinting the form, the $val will have values in an object form. while hwen we are adding new values in form, the $val will be in an array form. therefore we will use typecasting to convert object into array as =>
            $pAArr=(array)$val; --}}
            <div id="product_attr_box">

                {{-- this counter variable is bery important. it will give us the ID of blocks that we will be adding or removing. we will increment this through every loop --}}
                @php
                    $loop_count = 1000;
                @endphp
                @foreach ($productAttrArr as $key => $val)

                    {{-- Typecasting object into array --}}
                    @php
                        $pAArr = (array) $val;
                        $loop_count_prev = $loop_count;
                        
                    @endphp



                    <div class="card mt-3" id="product_attr_{{ $loop_count++ }}">
                        <div class="card-header">Product Attributes</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3 com-lg-3">
                                    <label for="mrp" class="control-label mb-1">MRP</label>
                                    <input id="mrp" required name="mrp[]" type="text" class="form-control"
                                        value="{{ $pAArr['mrp'] }} ">
                                    <span style="color:red">
                                        @error('mrp')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3 com-lg-3">
                                    <label for="price" class="control-label mb-1">Price</label>
                                    <input id="price" required name="price[]" type="text" class="form-control"
                                        value="{{ $pAArr['price'] }} ">
                                    <span style="color:red">
                                        @error('price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3 com-lg-3">
                                    <label for="qty" class="control-label mb-1">Qty</label>
                                    <input id="qty" name="qty[]" type="text" class="form-control"
                                        value="{{ $pAArr['qty'] }}">
                                    <span style="color:red">
                                        @error('qty')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3 com-lg-3">
                                    <label for="sku" class="control-label mb-1">Sku Code</label>
                                    <input id="sku" required name="sku[]" type="text" class="form-control"
                                        value="{{ $pAArr['sku'] }}">
                                    <span style="color:red">
                                        @error('sku.*')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="row">

                                {{-- Image --}}
                                <div class="form-group col-md-3 col-lg-3">
                                    <label for="attr_image" class="control-label mb-1">Attr Image</label>
                                    <input type="file" id="attr_image" name="attr_image[]" class="form-control">

                                    @if ($pAArr['attr_image'] != '')

                                        <img class="form-control" style="width:50%"
                                            src=" {{ asset('storage/media/product') . '/' . $pAArr['attr_image'] }} "
                                            alt="Not Found">

                                    @endif
                                    <span style="color:red">
                                        @error('attr_image.*')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3 col-lg-3">
                                    <label for="size" class="control-label mb-1">Select Size</label>

                                    <select class="form-control" id="size" name="size[]">
                                        <option value="">Please select size</option>
                                        @foreach ($size as $item)

                                            @if ($item->id == $pAArr['size_id'])
                                                <option selected value="{{ $item->id }} ">{{ $item->size }}</option>
                                            @else
                                                <option value="{{ $item->id }} ">{{ $item->size }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">
                                        @error('size')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3 col-lg-3">
                                    <label for="color" class="control-label mb-1">Select Color</label>

                                    <select class="form-control" id="color_id" name="color[]">
                                        <option value="">select</option>
                                        @foreach ($color as $item)

                                            @if ($item->id == $pAArr['color_id'])
                                                <option selected value="{{ $item->id }} ">{{ $item->color }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }} ">{{ $item->color }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">
                                        @error('color')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                {{-- here if counter is 2 or greater then it means we are editing because 2 is the first box since we increment it when we come accross it. so if 2 then add button otherwise remove button --}}
                                <div class="form-group col-md-3 com-lg-3">

                                    @if ($loop_count == 1001)
                                        <label for="sku" class="control-label mb-1">Add Button <br></label>

                                        <button type="button" style="font-size:17px" onclick="add_more()"
                                            class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount"><i class="fa fa-plus"></i>&nbsp;
                                                Add</span>
                                        </button>
                                    @else
                                        {{-- here we have to delete the row. we can do it in two ways. either through ajax or through page reload. lets do it on page reload. we are passing two IDs,
                                        1) on is forst product_attr id
                                        2) second one is the current product id on which all the data is being retrieved and filled in boxes --}}
                                        <label for="sku" class="control-label mb-1">Remove Button <br></label>

                                        <a
                                            href="{{ url('admin/product/product_attr_delete/' . $pAArr['id'] . '/' . $id) }} ">


                                            <button style="font-size:17px" type="button"
                                                class="btn btn-lg btn-warning btn-block">
                                                <span id="payment-button-amount"><i class="fa fa-plus"></i>&nbsp;
                                                    Remove</span>
                                            </button></a>
                                    @endif

                                </div>
                            </div>


                        </div>
                    </div>
                    {{--  --}}
                    <input type="hidden" name="paid[]" value="{{ $pAArr['id'] }}">

                @endforeach
            </div>

            <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block ">
                <span id="payment-button-amount">Submit</span>
            </button>

            <input type="hidden" name="id" value="{{ $id }}">


        </form>
    </div>

    <!-- END DATA TABLE-->
    <script>
        var counter = 1;

        function add_more() {
            counter += 1;
            var html =
                '<div class="card mt-3" id="product_attr_' + counter + '"><div class="card-body"><div class="row">';


            html +=
                '<div class="form-group col-md-3 com-lg-3"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp"  name="mrp[]" type="text" class="form-control" ></div>';

            html +=
                '<div class="form-group col-md-3 com-lg-3"><label for="price" class="control-label mb-1">Price</label><input id="price"  name="price[]" type="text" class="form-control" ></div>';

            html +=
                '<div class="form-group col-md-3 com-lg-3"><label for="qty" class="control-label mb-1">Qty</label><input id="qty"  name="qty[]" type="text" class="form-control" ></div>';

            html +=
                '<div class="form-group col-md-3 com-lg-3"><label for="sku" class="control-label mb-1">Sku</label><input id="sku"  name="sku[]" type="text" class="form-control" ></div>';

            html +=
                '<div class="form-group col-md-3 com-lg-3"><label for="attr_image" class="control-label mb-1">Image</label><input id="attr_image" required name="attr_image[]" type="file" class="form-control"></div>';

            var size_id_html = jQuery('#size').html();

            // now we have to remove the selected class from the select
            size_id_html = size_id_html.replace('selected', '');
            html +=
                '<div class="form-group col-md-3 col-lg-3"><label for="size" class="control-label mb-1">Select size</label><select class="form-control" id="size" name="size[]">' +
                size_id_html + '"></select></div>';

            var color_id_html = jQuery('#color_id').html();
            // now we have to remove the selected class from the select
            color_id_html = color_id_html.replace('selected', '');
            html +=
                '<div class="form-group col-md-3 col-lg-3"><label for="color" class="control-label mb-1">Select Color</label><select class="form-control" id="color" name="color[]">' +
                color_id_html + '</select></div>';

            // this is to update the product attr
            html += '<input type="hidden" name="paid[]">';

            html +=
                '<div class="form-group col-md-3 com-lg-3"><label for="remove_btn" class="control-label mb-1">Remove Button <br></label><button type="button" style="font-size:17px" onclick=remove("' +
                counter +
                '") class="btn btn-lg btn-warning btn-block"><span id="payment-button-amount"><i class="fa fa-minus"></i>&nbsp; Remove</span></button></div>';


            html += '</div></div></div>';
            jQuery('#product_attr_box').append(html);
        }

        var images_counter = 1;

        function add_more_images() {
            images_counter += 1;
            var temp_count = jQuery('#temp_count').val();
            var html =
                '<input type="hidden" id="piid" name="piid[]" ><div class="card mt-3" id="product_images_' +
                images_counter + '"><div class="card-body"><div class="row">';


            html +=
                '<div class="form-group col-md-3 com-lg-3"><label for="product_images" class="control-label mb-1">Image</label><input id="product_images" required name="product_images[]" type="file" class="form-control"></div>';

            html +=
                '<div class="form-group col-md-3 com-lg-3"><label for="remove_btn" class="control-label mb-1">Remove Button <br></label><button type="button" style="font-size:17px" onclick=remove_images("' +
                images_counter +
                '") class="btn btn-lg btn-warning btn-block"><span id="payment-button-amount"><i class="fa fa-minus"></i>&nbsp; Remove</span></button></div>';


            html += '</div></div></div>';
            jQuery('#product_images_box').append(html);
        }



        function remove(counter) {
            jQuery('#product_attr_' + counter).remove();
        }

        function remove_images(images_counter) {
            jQuery('#product_images_' + images_counter).remove();
        }

        CKEDITOR.replace('short_desc');
        CKEDITOR.replace('desc');
        CKEDITOR.replace('technical_specification');
    </script>
@endsection
