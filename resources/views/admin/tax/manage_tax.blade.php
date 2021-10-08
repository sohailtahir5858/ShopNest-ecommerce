@extends('admin.layout.layout');
@section('tax_select','active')
@section('page_title', 'Manage Tax')

@section('container')

        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <h3 class="mb-3">Manage Tax</h3>
            <a href="{{ url('admin/tax') }}">
                <button type="button" class="btn mb-3 btn-success btn-lg ">Back</button>
            </a>
            
            <div class="card">
                <div class="card-header">Credit Card</div>
                <div class="card-body">
                    
                    <form action="{{route('manage_tax_process')}} " method="post" >
                        {{@csrf_field()}}
                        <div class="form-group">
                            <label for="tax_desc" class="control-label mb-1">Tax Description</label>
                            <input id="tax_desc" name="tax_desc" type="text" class="form-control" required value="{{$tax_desc}} ">
                            <span style="color:red">
                                @error('tax_desc')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="value" class="control-label mb-1">Size</label>
                            <input id="value" name="value" type="text" class="form-control" required value="{{$value}} ">
                            <span style="color:red">
                                @error('value')
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
