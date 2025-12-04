@extends("Layouts.dashmaster")

@section('product-create')
<div class="main-container mt-4">
    <div class="pd-20 card-box mb-30">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-blue h4">Add New Product</h4>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">← Back</a>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Product Name</label>
                <input name="name" type="text" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Description</label>
                <input name="description" type="text" class="form-control" required>
            </div>

             <div class="form-group mb-3">
                <label>Long Description</label>
                <textarea name="longdescription" class="form-control"></textarea>
            </div>

            <div class="form-group mb-3">
                <label>Price</label>
                <input name="price" type="number" step="0.01" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Stock</label>
                <input name="stock" type="number" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Select Category</label>
                <select name="category_id" class="form-control" required>
                    <option disabled selected>-- choose --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Product Image</label>
                <input name="image" type="file" class="form-control">
            </div>

            <button class="btn btn-primary mt-3">Save Product</button>
        </form>
    </div>
</div>
@endsection
