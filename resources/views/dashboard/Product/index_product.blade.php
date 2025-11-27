@extends("Layouts.dashmaster")

@section('product-index')
<div class="main-container mt-4">

    <div class="pd-20 card-box mb-30">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-blue h4">All Products</h4>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                + Add New Product
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Product Code</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th width="180px">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->product_code }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->category->name }}</td>

                        <td>
                            @if($p->image)
                                <img src="{{ asset('storage/'.$p->image) }}"
                                     width="60" height="60" style="object-fit:cover; border-radius:5px;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>

                        <td>{{ number_format($p->price, 2) }}</td>
                        <td>{{ $p->stock }}</td>

                        <td>
                            <a href="{{ route('products.edit', $p->id) }}" class="btn btn-sm btn-info">
                                Edit
                            </a>

                            <form action="{{ route('products.destroy', $p->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete product?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $products->links() }}
            </div>

        </div>

    </div>
</div>
@endsection
