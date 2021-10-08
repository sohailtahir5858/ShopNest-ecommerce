@extends('admin.layout.layout');
@section('customer_select', 'active')
@section('page_title', 'Customer Detail')

@section('container')

    <!-- DATA TABLE-->
    <h3 class="mb-3">Customer Details</h3>
    <a class="btn btn-primary btn-lg mb-3" href="{{ url('admin/customer') }}">Back</a>
    @if (session()->has('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- TOP CAMPAIGN-->

    <div class="top-campaign">
        <h3 class="title-3 m-b-30">Customer Detail</h3>
        <div class="table-responsive">
            <table class="table table-top-campaign">
                <tbody>
                    <tr>
                        <td style="width:30%" class="c_font">Name</td>
                        <td class="c_font">{{ $customer_list->name }}</td>
                    </tr>
                    <tr>
                        <td class="c_font">Email</td>
                        <td class="c_font">{{ $customer_list->email }}</td>
                    </tr>
                    <tr>
                        <td class="c_font">Mobile</td>
                        <td class="c_font">{{ $customer_list->mobile }}</td>
                    </tr>

                    <tr>
                        <td class="c_font">Address</td>
                        <td class="c_font">{{ $customer_list->address }}</td>
                    </tr>
                    <tr>
                        <td class="c_font">City</td>
                        <td class="c_font">{{ $customer_list->city }}</td>
                    </tr>
                    <tr>
                        <td class="c_font">State</td>
                        <td class="c_font">{{ $customer_list->state }}</td>
                    </tr>

                    <tr>
                        <td class="c_font">Zip</td>
                        <td class="c_font">{{ $customer_list->zip }}</td>
                    </tr>
                    <tr>
                        <td class="c_font">Company</td>
                        <td class="c_font">{{ $customer_list->company }}</td>
                    </tr>
                    <tr>
                        <td class="c_font">GST Number</td>
                        <td class="c_font">{{ $customer_list->gstin }}</td>
                    </tr>

                    <tr>
                        <td class="c_font">Created At</td>
                        <td class="c_font">{{ \Carbon\Carbon::parse($customer_list->created_at)->format('d-m-Y h:i') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="c_font">Uploaded At</td>
                        <td class="c_font">{{\Carbon\Carbon::parse($customer_list->updated_at)->format('d-m-Y')}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!--  END TOP CAMPAIGN-->
    </div>
    <!-- END DATA TABLE-->
@endsection
