@extends('admin.layout.layout');
@section('banner_select', 'active')
@section('page_title', 'Manage banner')

@section('container')

    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <h3 class="mb-3">Manage banner</h3>
        <a href="{{ url('admin/banner') }}">
            <button type="button" class="btn mb-3 btn-success btn-lg ">Back</button>
        </a>

        <div class="card">
            <div class="card-header">Credit Card</div>
            <div class="card-body">

                <form action="{{ route('manage_banner_process') }} " method="post" enctype="multipart/form-data">
                    {{ @csrf_field() }}

                    <div class="row">

                        <div class="form-group col-md-4 col-lg-4">
                            <label for="name" class="control-label mb-1">Name</label>
                            <input id="name" name="name" type="text" class="form-control" " value=" {{ $name }} ">
                                        <span style=" color:red">
                            @error('name')
                                {{ $message }}
                            @enderror
                            </span>
                        </div>
                        
                        <div class="form-group col-md-4 col-lg-4">
                            <label for="button_text" class="control-label mb-1">Button Text</label>
                            <input id="button_text" name="button_text" type="text" class="form-control" " value=" {{ $button_text }} ">
                                        <span style=" color:red">
                            @error('button_text')
                                {{ $message }}
                            @enderror
                            </span>
                        </div>

                        <div class="form-group col-md-4 col-lg-4">
                            <label for="button_link" class="control-label mb-1">Button Link</label>
                            <input id="button_link" name="button_link" type="text" class="form-control" " value=" {{ $button_link }} ">
                                        <span style=" color:red">
                            @error('button_link')
                                {{ $message }}
                            @enderror
                            </span>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="short_desc" class="control-label mb-1">Short Desc</label>
                        <input id="short_desc" name="short_desc" type="text" class="form-control" " value=" {{ $short_desc }} ">
                                    <span style=" color:red">
                        @error('short_desc')
                            {{ $message }}
                        @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="image" class="control-label mb-1">Image</label>
                        <input id="image" name="image" type="file" class="form-control">
                        <span style=" color:red">
                            @if ($image != '')
                                <img class="form-control" style="width:150px"
                                    src="{{ asset('storage/media/banner' . '/' . $image) }}" alt="">

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
