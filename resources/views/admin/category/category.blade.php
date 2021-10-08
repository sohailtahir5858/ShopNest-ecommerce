@extends('admin.layout.layout');
@section('category_select','active')
@section('page_title', 'Category')

@section('container')

        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <h3 class="mb-3">Dashboard</h3>
            <a href="{{ url('admin/category/add') }}">
                <button type="button" class="btn mb-3 btn-success btn-lg ">Add Category</button>
            </a>
            @if (session()->has('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>S#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php $counter=0?>
                    @foreach ($result as $item)
                    
                        <tr>
                        <td>{{++$counter}} </td>
                        <td>{{$item->category_name}} </td>
                        <td>{{$item->category_slug}} </td>
                        <td>
       <a href=" {{url('admin/category/edit/'.$item->id)}} " class="btn btn-primary">Edit</a>

       @if ($item->status == 1)
             <a href=" {{url('admin/category/status/0/'.$item->id)}}" class="btn btn-success">Active</a>
       @elseif ($item->status == 0)
            <a href=" {{url('admin/category/status/1/'.$item->id)}}" class="btn btn-warning">Deactive</a>
       @endif

       <a href=" {{url('admin/category/delete/'.$item->id)}} " class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
@endsection