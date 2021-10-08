@extends('admin.layout.layout');
@section('coupon_select', 'active')
@section('page_title', 'Manage Coupon')

@section('container')

    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <h3 class="mb-3">Manage Coupon</h3>
        <a href="{{ url('admin/coupon') }}">
            <button type="button" class="btn mb-3 btn-success btn-lg ">Back</button>
        </a>

        <div class="card">
            <div class="card-header">Credit Card</div>
            <div class="card-body">

                <form action="{{ route('manage_coupon_process') }} " method="post">
                    {{ @csrf_field() }}
                    <div class="form-group">
                        <label for="title" class="control-label mb-1">Coupon Title</label>
                        <input id="title" name="title" type="text" class="form-control" required aria-required="true"
                            aria-invalid="false" value="{{ $title }} ">
                        <span style="color:red">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-6 com-lg-6">
                            <label for="code" class="control-label mb-1">Coupon Code</label>
                            <input id="code" name="code" type="text" class="form-control" required aria-required="true"
                                aria-invalid="false" value="{{ $code }} ">
                            <span style="color:red">
                                @error('code')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group col-md-6 com-lg-6">
                            <label for="value" class="control-label mb-1">value</label>
                            <input id="value" required name="value" type="text" class="form-control" aria-required="true"
                                aria-invalid="false" value="{{ $value }} ">
                            <span style="color:red">
                                @error('value')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>



                    <div class="row">

                        <div class="form-group col-md-4 com-lg-4">
                            <label for="type" class="control-label mb-1">Type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="">Select</option>
                                @if ($type == 'value')
                                    <option selected value="value">Value</option>
                                    <option value="perc">Percentage</option>
                                @elseif ($type == '0')
                                    <option value="value">Value</option>
                                    <option selected value="perc">Percentage</option>
                                @else
                                    <option value="value">value</option>
                                    <option value="perc">perc</option>
                                @endif
                            </select>
                            <span style="color:red">
                                @error('type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <div class="form-group col-md-4 com-lg-4">
                            <label for="min_order_amount" class="control-label mb-1">Minumim Order Amount</label>
                            <input id="min_order_amount" required name="min_order_amount" type="text" class="form-control"
                                value="{{ $min_order_amount }} ">
                            <span style="color:red">
                                @error('min_order_amount')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group col-md-4 com-lg-4">
                            <label for="is_one_time" class="control-label mb-1">Is One Time</label>
                            <select class="form-control" id="is_one_time" name="is_one_time">
                                <option value="">Select</option>
                                @if ($is_one_time == '1')
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                @elseif ($is_one_time == '0')
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                @else
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                @endif
                            </select>
                            <span style="color:red">
                                @error('is_one_time')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>

                    <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Submit</span>
                    </button>
                    {{ session('msg') }}
            </div>
            <input type="hidden" name="id" value="{{ $id }}">
            </form>
        </div>
    </div>
    </div>
    <!-- END DATA TABLE-->

@endsection
