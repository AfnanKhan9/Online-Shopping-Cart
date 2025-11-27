@extends('Layouts.dashmaster')
@section('customercontent')
<div class="pd-20 card-box mb-30">

    <div class="clearfix mb-20">
        <div class="pull-left">
            <h4>Employee Table</h4>
        </div>
        {{-- <div class="pull-right">
            <a href="{{ route('') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-user"></i> Create Customer
            </a>
        </div> --}}
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Customer_id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer as $custom)
                    <tr>
                        <td>{{ $custom->id }}</td>
                        <td>{{ $custom->name }}</td>
                        <td>{{ $custom->email }}</td>
                        <td>{{ $custom->phone }}</td>
                        <td>{{ $custom->address }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $custom->id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('customers.destroy', $custom->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
