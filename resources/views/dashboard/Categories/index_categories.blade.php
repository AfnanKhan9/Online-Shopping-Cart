@extends('Layouts.dashmaster')
@section('categorycontent')
    <!-- Category Table Start -->
    <div class="container-fluid">
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Category List</h4>
                <p class="mb-0">Manage your categories here.</p>
            </div>
            <div class="pb-20">
                <div class="table-responsive">
                    <table class="data-table table stripe hover nowrap w-100">
                        <thead>
                            <tr>
                                <th class="datatable-nosort">ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                            <a class="dropdown-item" href="{{ route('categories.create') }}"><i class="dw dw-eye"></i>
                                Create Category</a>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        
                                            


                                                <a class="dropdown-item"
                                                    href="{{ route('categories.edit', $category->id) }}"><i
                                                        class="dw dw-edit2"></i> Edit</a>
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="dw dw-delete-3"></i> Delete
                                                    </button>
                                                </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Category Table End -->
@endsection
