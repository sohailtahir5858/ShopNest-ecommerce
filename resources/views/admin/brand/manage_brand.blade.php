@extends('admin.layout.layout');
@section('brand_select', 'active')
@section('page_title', 'Manage Brand')

@section('container')

    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <h3 class="mb-3">Manage Brand</h3>
        <a href="{{ url('admin/brand') }}">
            <button type="button" class="btn mb-3 btn-success btn-lg ">Back</button>
        </a>

        <div class="card">
            <div class="card-header">Credit Card</div>
            <div class="card-body">

                <form action="{{ route('manage_brand_process') }} " method="post" enctype="multipart/form-data">
                    {{ @csrf_field() }}

                    <div class="row">

                        <div class="form-group col-md-6 col-lg-6">
                            <label for="name" class="control-label mb-1">Name</label>
                            <input id="name" name="name" type="text" class="form-control" " value=" {{ $name }} ">
                                        <span style=" color:red">
                            @error('name')
                                {{ $message }}
                            @enderror
                            </span>
                        </div>

                        <div class="form-group col-md-6 col-lg-6">
                            <label for="is_home" class="control-label mb-1">Is Home</label>
                            <select class="form-control" id="is_home" name="is_home">
                                <option value="">Select</option>
                                @if ($is_home == '1')
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                @elseif ($is_home == '0')
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                @else
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                @endif
                            </select>
                            <span style="color:red">
                                @error('is_home')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="image" class="control-label mb-1">Image</label>
                        <input id="image" name="image" type="file" class="form-control">
                        <span style=" color:red">
                            @if ($image != '')
                                <img class="form-control" style="width:150px"
                                    src="{{ asset('storage/media/brand' . '/' . $image) }}" alt="">

                            @endif

                            @error('image')
                                {{ $message }}
                            @enderror
                        </span>
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
