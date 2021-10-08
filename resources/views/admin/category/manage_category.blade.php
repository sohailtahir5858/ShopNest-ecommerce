@extends('admin.layout.layout');
@section('category_select', 'active')
@section('page_title', 'Manage Category')

@section('container')

    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <h3 class="mb-3">Manage Category</h3>
        <a href="{{ url('admin/category') }}">
            <button type="button" class="btn mb-3 btn-success btn-lg ">Back</button>
        </a>

        <div class="card">
            <div class="card-header">Credit Card</div>
            <div class="card-body">

                <form action="{{ route('manage_category_process') }} " method="post" enctype="multipart/form-data">
                    {{ @csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-3 col-lg-4">
                            <label for="category" class="control-label mb-1">Category</label>
                            <input id="category" name="category" type="text" class="form-control" required
                                aria-required="true" aria-invalid="false" value="{{ $category_name }} ">
                            <span style="color:red">
                                @error('category')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group col-md-4 col-lg-4">
                            <label for="parent_category_id" class="control-label mb-1">Select Parant Category</label>

                            <select class="form-control" id="parent_category_id" name="parent_category_id">
                                <option value="">Select</option>
                                @foreach ($categories as $item)
                                    @if ($item->id == $parent_category_id)
                                        <option selected value="{{ $item->id }} ">{{ $item->category_name }}</option>
                                    @else
                                        <option value="{{ $item->id }} ">{{ $item->category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span style="color:red">
                                @error('parent_category_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <div class="form-group col-md-4 col-lg-4">
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


                    <div class="row">
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="image" class="control-label mb-1">Image</label>
                            <input type="file" id="image" name="image" class="form-control">

                            @if ($image != '')
                                <img class="form-control" style="width:50%"
                                    src="{{ asset('storage/media/category/') . '/' . $image }}" alt="Image not found">
                            @endif

                            <span style="color:red">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="slug" class="control-label mb-1">Slug</label>
                            <input id="slug" required name="slug" type="text" class="form-control" aria-required="true"
                                aria-invalid="false" value="{{ $category_slug }} ">
                            <span style="color:red">
                                @error('slug')
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
