@extends('front/layout/layout')
@section('page_title', 'Cart Page')
@section('container')




    <!-- Cart view section -->
    <section id="cart-view">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            <form action="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($cartData))
                                                @foreach ($cartData as $list)
                                                <tr id="cart_box{{ $list->cart_id }}">
                                                    <td><a class="remove"
                                                            onclick="deleteQty('{{ $list->pid }}','{{ $list->color }}','{{ $list->size }}','{{ $list->attr_id }}','{{ $list->cart_id }}')"
                                                            href="javascript:void(0)">
                                                            <fa class="fa fa-close"></fa>
                                                        </a></td>
                                                    <td><a href="{{ url('/front/product/' . $list->slug) }}"><img
                                                                src="{{ asset('storage/media/product/' . $list->image) }}"
                                                                alt="img"></a></td>

                                                    <td><a class="aa-cart-title"
                                                            href="{{ url('/front/product/' . $list->slug) }}">
                                                            {{ $list->name }} </a></td>
                                                    <td>{{ $list->price }}</td>


                                                    <td><input class="aa-cart-quantity"
                                                            onchange="updateQty('{{ $list->pid }}','{{ $list->color }}','{{ $list->size }}','{{ $list->attr_id }}','{{ $list->cart_id }}','{{ $list->price }}')"
                                                            id="qty_cart_{{ $list->cart_id }}" type="number"
                                                            value="{{ $list->qty }}"></td>


                                                    <td id="total_cart_{{ $list->cart_id }}">RS
                                                        {{ $list->price * $list->qty }} </td>
                                                </tr>
                                            @endforeach
                                            @else
                                            <h3>No Data In your Cart</h3>
                                            @endif
                                            

                                            <tr>
                                                <td colspan="6" class="aa-cart-view-bottom">
                                                    <div class="aa-cart-coupon">
                                                        <input class="aa-coupon-code" type="text" placeholder="Coupon">
                                                        <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                                                    </div>
                                                    <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <!-- Cart Total view -->
                            <div class="cart-view-total">
                                <h4>Cart Totals</h4>
                                <table class="aa-totals-table">
                                    <tbody>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>$450</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td>$450</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Cart view section -->

    <form id="formAddToCart">
        <input type="hidden" id="size-val-id" name="size_val-id">
        <input type="hidden" id="color-val-id" name="color_val_id">
        <input type="hidden" id="qty" name="qty">
        <input type="hidden" id="product_id" name="product_id">

        @csrf
    </form>

@endsection
