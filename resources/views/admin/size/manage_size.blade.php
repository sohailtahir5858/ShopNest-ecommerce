@extends('admin.layout.layout');
@section('size_select','active')
@section('page_title', 'Manage Size')

@section('container')

        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <h3 class="mb-3">Manage Size</h3>
            <a href="{{ url('admin/size') }}">
                <button type="button" class="btn mb-3 btn-success btn-lg ">Back</button>
            </a>
            
            <div class="card">
                <div class="card-header">Credit Card</div>
                <div class="card-body">
                    
                    <form action="{{route('manage_size_process')}} " method="post" >
                        {{@csrf_field()}}
                        <div class="form-group">
                            <label for="size" class="control-label mb-1">Size</label>
                            <input id="size" name="size" type="text" class="form-control" required aria-required="true" aria-invalid="false" value="{{$size}} ">
                            <span style="color:red">
                                @error('size')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>

                        
                            <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            {{session('msg')}}
                        </div>
                        <input type="hidden" name="id" value="{{$id}}">
                    </form>
                </div>
            </div>
        </div>
        <!-- END DATA TABLE-->
   
@endsection
