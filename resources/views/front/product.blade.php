@extends('front/layout/layout')
@section('page_title', $product[0]->name)

@section('container')


    @php
    // foreach ($product_images as $list ) {
    //     echo $list->images;    # code...
    // }
    // // prx($product_images);
    // die();
    @endphp

    <!-- product category -->
    <section id="aa-product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-product-details-area">
                        <div class="aa-product-details-content">
                            <div class="row">
                                <!-- Modal view slider -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="aa-product-view-slider">
                                        <div id="demo-1" class="simpleLens-gallery-container">
                                            <div class="simpleLens-container">
                                                <div class="simpleLens-big-image-container"><a
                                                        data-lens-image="{{ asset('storage/media/product/' . $product[0]->image) }}"
                                                        class="simpleLens-lens-image"><img
                                                            src="{{ asset('storage/media/product/' . $product[0]->image) }}"
                                                            class="simpleLens-big-image"></a></div>
                                            </div>
                                            <div class="simpleLens-thumbnails-container">
                                                <a data-big-image="{{ asset('storage/media/product/' . $product[0]->image) }}"
                                                    data-lens-image="{{ asset('storage/media/product/' . $product[0]->image) }}"
                                                    class="simpleLens-thumbnail-wrapper" href="#">
                                                    <img src="{{ asset('storage/media/product/' . $product[0]->image) }}"
                                                        style="width:50px">
                                                </a>

                                                @if ($product_images != '')
                                                    @foreach ($product_images as $list)
                                                        <a data-big-image="{{ asset('storage/media/product/' . $list->images) }}"
                                                            data-lens-image="{{ asset('storage/media/product/' . $list->images) }}"
                                                            class="simpleLens-thumbnail-wrapper" href="#">
                                                            <img src="{{ asset('storage/media/product/' . $list->images) }}"
                                                                style="width:50px">
                                                        </a>
                                                    @endforeach
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal view content -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="aa-product-view-content">
                                        <h3>{{ $product['0']->name }}</h3>
                                        <div class="aa-price-block">
                                            <span
                                                class="aa-product-view-price"><del>{{ $product_attr[0]->mrp }}</del></span>
                                            <span class="aa-product-view-price">{{ $product_attr[0]->price }}</span>
                                            <p class="aa-product-avilability">Avilability: <span>In stock</span></p>

                                            @if ($product[0]->lead_time != '')
                                                <p class="aa-product-avilability">Lead Time: <span>
                                                        {{ $product[0]->lead_time }}
                                                    </span></p>
                                            @endif
                                        </div>
                                        <p>
                                            {!! $product[0]->short_desc !!}
                                        </p>
                                        @if ($product_attr[0]->size_id > 0)
                                        <h4>Size</h4>
                                        @php
                                            $arrSize = [];
                                            foreach ($product_attr as $list) {
                                                $arrSize[] = $list->size;
                                            }
                                            $arrSize = array_unique($arrSize);
                                        @endphp
                                        <div class="aa-prod-view-size">
                                            @foreach ($arrSize as $list)
                                                @if ($list != '')
                                                    <a class="size-id-class" id="size_id_{{ $list }}"
                                                        href="javascript:void(0)"
                                                        onclick="showColor('{{ $list }}')">{{ $list }}
                                                    </a>
                                                @endif
                                            @endforeach

                                        </div>
                                        @endif
                                        <h4>Color</h4>
                                        @if ($product_attr[0]->color_id > 0)
                                            <div class="aa-color-tag">
                                                @foreach ($product_attr as $list)
                                                    @if ($list->color != '')
                                                        <a href="javascript:void(0)"
                                                            onclick="change_product_color_iamge('{{ asset('storage/media/product/' . $list->attr_image) }}','{{ $list->color }}')"
                                                            class="{{ $list->size }} product-color aa-color-{{ $list->color }}"></a>

                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                            @php
                                                
                                            @endphp

                                        <div class="aa-prod-quantity">
                                            <form action="">
                                                <select id="qty-select-id" name="">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <option value='{{ $i }}'>{{ $i }}</option>

                                                    @endfor
                                                </select>
                                            </form>
                                            <p class="aa-prod-category">
                                                Model <a href="#">{{ $product[0]->model }}</a>
                                            </p>
                                        </div>
                                        <div class="aa-prod-view-bottom">
                                            <a class="aa-add-to-cart-btn" href="javascript:void(0)"
                                                onclick="add_to_cart('{{ $product['0']->id }}','','')">Add To Cart</a>
                                            <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                                            <a class="aa-add-to-cart-btn" href="#">Compare</a>
                                        </div>
                                        <span id="cart_msg" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aa-product-details-bottom">
                            <ul class="nav nav-tabs" id="myTab2">
                                <li><a href="#description" data-toggle="tab">Description</a></li>
                                <li><a href="#technical_specification" data-toggle="tab">technical Specification</a></li>

                                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                                <li><a href="#warranty" data-toggle="tab">warranty</a></li>
                                <li><a href="#review" data-toggle="tab">Reviews</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="description">
                                    <p>
                                        {!! $product[0]->desc !!}

                                    </p>
                                </div>
                                <div class="tab-pane fade in " id="technical_specification">
                                    <p>
                                        {!! $product[0]->technical_specification !!}

                                    </p>
                                </div>
                                <div class="tab-pane fade in " id="uses">
                                    <p>
                                        {!! $product[0]->uses !!}

                                    </p>
                                </div>
                                <div class="tab-pane fade in " id="warranty">
                                    <p>
                                        {!! $product[0]->waranty !!}

                                    </p>
                                </div>
                                <div class="tab-pane fade " id="review">
                                    <div class="aa-product-review-area">
                                        <h4>2 Reviews for T-Shirt</h4>
                                        <ul class="aa-review-nav">
                                            <li>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="img/testimonial-img-3.jpg"
                                                                alt="girl image">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March
                                                                26, 2016</span></h4>
                                                        <div class="aa-product-rating">
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="img/testimonial-img-3.jpg"
                                                                alt="girl image">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March
                                                                26, 2016</span></h4>
                                                        <div class="aa-product-rating">
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <h4>Add a review</h4>
                                        <div class="aa-your-rating">
                                            <p>Your Rating</p>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                        </div>
                                        <!-- review form -->
                                        <form action="" class="aa-review-form">
                                            <div class="form-group">
                                                <label for="message">Your Review</label>
                                                <textarea class="form-control" rows="3" id="message"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="example@gmail.com">
                                            </div>

                                            <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Related product -->
                        <div class="aa-product-related-item">
                            <h3>Related Products</h3>
                            <ul class="aa-product-catg aa-related-item-slider">
                                @if (isset($related_product[0]))

                                    @foreach ($related_product as $p_item)

                                        {{-- @php
                                    echo $related_product_attr[0]->price ;die();
                                @endphp --}}

                                        <li>
                                            <figure>
                                                <a class="home_p_img aa-product-img"
                                                    href="{{ url('front/product/' . $p_item->slug) }}"><img
                                                        style="width:240px; height:303px;"
                                                        src="{{ asset('storage/media/product' . '/' . $p_item->image) }}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>

                                                <figcaption>
                                                    <h4 class="aa-product-title"><a
                                                            href="{{ url('front/product/' . $p_item->slug) }}">{{ $p_item->name }}</a>
                                                    </h4>
                                                    <span
                                                        class="aa-product-price">{{ $related_product_attr[0]->price }}</span><span
                                                        class="aa-product-price"><del>{{ $related_product_attr[0]->mrp }}</del></span>
                                                </figcaption>
                                            </figure>

                                        </li>
                                    @endforeach

                                @else

                                    <li>
                                        <figure>
                                            No Data found
                                        </figure>
                                    </li>

                                @endif
                                <!-- start single product item -->

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="formAddToCart">
            <input type="hidden" id="size-val-id" name="size_val-id">
            <input type="hidden" id="color-val-id" name="color_val_id">
            <input type="hidden" id="qty" name="qty">
            <input type="hidden" id="product_id" name="product_id">

            @csrf
        </form>
    </section>
    <!-- / product category -->



@endsection
