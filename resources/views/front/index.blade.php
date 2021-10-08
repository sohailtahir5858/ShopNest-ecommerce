@extends('front/layout/layout')
@section('page_title','Home Page')
@section('container')

    <!-- Start slider -->
    <section id="aa-slider">
        <div class="aa-slider-area">
            <div id="sequence" class="seq">
                <div class="seq-screen">
                    <ul class="seq-canvas">
                        <!-- single slide item -->
                        @foreach ($banners as $banner_list)
                            <li>
                                <div class="seq-model">
                                    <img data-seq src="{{ asset('storage/media/banner' . '/' . $banner_list->image) }}"
                                        alt="Men slide img" />
                                </div>
                                <div class="seq-title">
                                    <span data-seq>Save Up to 75% Off</span>
                                    <h2 data-seq>{{ $banner_list->name }}</h2>
                                    <p data-seq>{{ $banner_list->short_desc }}</p>
                                    <a data-seq href="{{ $banner_list->button_link }}"
                                        class="aa-shop-now-btn aa-secondary-btn">{{ $banner_list->button_text }}</a>
                                </div>
                            </li>
                        @endforeach

                        <!-- single slide item -->

                    </ul>
                </div>
                <!-- slider navigation btn -->
                <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                    <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
                    <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
                </fieldset>
            </div>
        </div>
    </section>
    <!-- / slider -->

    <!-- Start Promo section -->
    <section id="aa-promo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-promo-area">
                        <div class="col-md-12 ">
                            <div class="aa-promo-right">
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($home_categories as $list)
                                    @if ($counter++ < 4)
                                        <div class="aa-single-promo-right">

                                            <div class="aa-promo-banner">
                                                <img src="{{ asset('storage/media/category' . '/' . $list->image) }}"
                                                    alt="img not found">
                                                <div class="aa-prom-content">
                                                    <span>Exclusive Item</span>
                                                    <h4><a
                                                            href="{{ url('category/' . $list->category_slug) }}">{{ $list->category_name }}</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <!-- / Promo section -->

    <!-- Products section -->
    <section id="aa-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="aa-product-area">
                            <div class="aa-product-inner">
                                <!-- start prduct navigation -->
                                <ul class="nav nav-tabs aa-products-tab">
                                    @foreach ($home_categories as $list)
                                        <li class=""><a href=" #cat{{ $list->id }}" data-toggle="tab">
                                            {{ $list->category_name }}</a></li>
                                    @endforeach


                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    @php
                                        $loopcount = 1;
                                    @endphp
                                    @foreach ($home_categories as $list)

                                        @php
                                            if ($loopcount == 1) {
                                                $loopcount++;
                                                $mactive = 'active';
                                            } else {
                                                $mactive = '';
                                            }
                                        @endphp
                                        <!-- Start men product category -->
                                        <div class="tab-pane fade in {{ $mactive }}" id="cat{{ $list->id }}">
                                            <ul class="aa-product-catg col-md-12">

                                                @if (isset($home_categories_product[$list->id][0]))

                                                    @foreach ($home_categories_product[$list->id] as $p_item)


                                                        <li>
                  <a class="home_p_img aa-product-img" href="{{ url('front/product/' . $p_item->slug) }}"><img style="width:240px; height:303px;"
                                                                        src="{{ asset('storage/media/product' . '/' . $p_item->image) }}"
                                                                        alt="polo shirt img"></a>
<a class="aa-add-card-btn" href="javascript:void(0)"  onclick="home_add_to_cart('{{ $p_item->id }}','{{$home_product_attr[$p_item->id][0]->color}}','{{$home_product_attr[$p_item->id][0]->size}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>

                                                                <figcaption>
                                                                    <h4 class="aa-product-title"><a
                                                                            href="{{ url('front/product/' . $p_item->slug) }}">{{ $p_item->name }}</a>
                                                                    </h4>
                                                                    <span
                                                                        class="aa-product-price">{{ $home_product_attr[$p_item->id][0]->price }}</span><span
                                                                        class="aa-product-price"><del>{{ $home_product_attr[$p_item->id][0]->mrp }}</del></span>
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
                                        <!-- / men product category -->
                                    @endforeach


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Products section -->


    {{-- Banner section --}}
    <section id="aa-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="aa-banner-area">
                            <a href="#"><img src="{{ asset('front_assets/img/fashion-banner.jpg') }}"
                                    alt="fashion banner img"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- popular section -->
    <section id="aa-popular-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="aa-popular-category-area">
                            <!-- start prduct navigation -->
                            <ul class="nav nav-tabs aa-products-tab">
                                <li class=""><a href=" #featured" data-toggle="tab">Featured</a></li>
                                <li><a href="#discounted" data-toggle="tab">Discounted</a></li>
                                <li><a href="#trending" data-toggle="tab">Trending</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content" style=" margin-left: -100px !important;">
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($home_categories as $list)

                                    @php
                                        if ($counter == 1) {
                                            $counter++;
                                            $mactive = 'active';
                                        } else {
                                            $mactive = '';
                                        }
                                    @endphp
                                    <!-- Start men Featured category -->
                                    <div class="tab-pane fade in {{ $mactive }}" id="featured">
                                        <ul class="aa-product-catg aa-popular-slider">
                                            <!-- start single product item -->
                                            @if (isset($home_featured_product[$list->id][0]))

                                                @foreach ($home_featured_product[$list->id] as $p_item)


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
                                                                    class="aa-product-price">{{ $home_product_attr[$p_item->id][0]->price }}</span><span
                                                                    class="aa-product-price"><del>{{ $home_product_attr[$p_item->id][0]->mrp }}</del></span>
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
                                    <!-- / popular Featured category -->

                                    @php
                                        // echo '<pre>';
                                        //     print_r($home_categories_product[15]);
                                        //     die();
                                    @endphp
                                    <!-- start Discontinued category -->
                                    <div class="tab-pane fade" id="discounted">
                                        <ul class="aa-product-catg aa-featured-slider">
                                            <!-- start single product item -->
                                            @if (isset($home_discounted_product[$list->id][0]))

                                                @foreach ($home_discounted_product[$list->id] as $p_item)


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
                                                                    class="aa-product-price">{{ $home_product_attr[$p_item->id][0]->price }}</span><span
                                                                    class="aa-product-price"><del>{{ $home_product_attr[$p_item->id][0]->mrp }}</del></span>
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



                                        </ul>
                                        <a class="aa-browse-btn" href="#">Browse all Product <span
                                                class="fa fa-long-arrow-right"></span></a>
                                    </div>
                                    <!-- / Discontinued category -->

                                    <!-- Trending category -->
                                    <div class="tab-pane fade" id="trending">
                                        <ul class="aa-product-catg aa-latest-slider">
                                            <!-- start single product item -->
                                            @if (isset($home_trending_product[$list->id][0]))

                                                @foreach ($home_trending_product[$list->id] as $p_item)


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
                                                                    class="aa-product-price">{{ $home_product_attr[$p_item->id][0]->price }}</span><span
                                                                    class="aa-product-price"><del>{{ $home_product_attr[$p_item->id][0]->mrp }}</del></span>
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

                                        </ul>
                                        <a class="aa-browse-btn" href="#">Browse all Product <span
                                                class="fa fa-long-arrow-right"></span></a>
                                    </div>
                                    <!-- / Trending category -->
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / popular section -->


    <!-- Support section -->
    <section id="aa-support">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-support-area">
                        <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-truck"></span>
                                <h4>FREE SHIPPING</h4>
                                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                            </div>
                        </div>
                        <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-clock-o"></span>
                                <h4>30 DAYS MONEY BACK</h4>
                                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                            </div>
                        </div>
                        <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-phone"></span>
                                <h4>SUPPORT 24/7</h4>
                                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Support section -->

    <!-- Client Brand -->
    <!-- Client Brand -->
    <section id="aa-client-brand">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-client-brand-area">
                        <ul class="aa-client-brand-slider">">
                            @foreach ($home_brands as $brand)
                                <li><a href="#"><img src="{{ asset('storage/media/brand/' . $brand->image) }}"
                                            alt="java img"></a></li>
                            @endforeach


                        </ul>
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
    <!-- / Client Brand -->






@endsection
