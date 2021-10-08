@extends('admin.layout.layout');
@section('customer_select', 'active')
@section('page_title', 'Customer')

@section('container')

    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <h3 class="mb-3">Customer</h3>
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
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php $counter = 0; ?>
                @foreach ($result as $item)

                    <tr>
                        <td>{{ ++$counter }} </td>
                        <td>{{ $item->name }} </td>
                        <td>{{ $item->email }} </td>
                        <td>{{ $item->mobile }} </td>
                        <td>{{ $item->city }} </td>
                        <td>


                            <a class="btn btn-info" href="{{url('admin/customer/show/'.$item->id)}}">View</a>
                            @if ($item->status == 1)
                                <a href=" {{ url('admin/customer/status/0/' . $item->id) }}" class="btn btn-success">Active</a>
                            @elseif ($item->status == 0)
                                <a href=" {{ url('admin/customer/status/1/' . $item->id) }}"
                                    class="btn btn-warning">Deactive</a>
                            @endif

                            <a href=" {{ url('admin/customer/delete/' . $item->id) }} " class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
@endsection
