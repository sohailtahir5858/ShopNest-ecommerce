@extends('admin.layout.layout');
@section('color_select','active')
@section('page_title', 'Manage Color')

@section('container')

        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <h3 class="mb-3">Manage Color</h3>
            <a href="{{ url('admin/color') }}">
                <button type="button" class="btn mb-3 btn-success btn-lg ">Back</button>
            </a>
            
            <div class="card">
                <div class="card-header">Credit Card</div>
                <div class="card-body">
                    
                    <form action="{{route('manage_color_process')}} " method="post" >
                        {{@csrf_field()}}
                        <div class="form-group">
                            <label for="color" class="control-label mb-1">Color</label>
                            <input id="color" name="color" type="text" class="form-control" required aria-required="true" aria-invalid="false" value="{{$color}} ">
                            <span style="color:red">
                                @error('color')
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
