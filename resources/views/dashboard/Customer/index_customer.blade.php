@extends('Layouts.dashmaster')

@section('customercontent')
<div class="pd-20 card-box mb-30">

    <div class="clearfix mb-20">
        <div class="pull-left">
            <h4>Customer Table</h4>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $custom)
                    <tr>
                        <td>{{ $custom->id }}</td>
                        <td>{{ $custom->name }}</td>
                        <td>{{ $custom->email }}</td>
                        <td>{{ $custom->phone }}</td>
                        <td>{{ $custom->address }}</td>
                        <td>
                            

                            <form action="{{ route('customers.destroy', $custom->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
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
