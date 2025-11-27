@extends("Layouts.dashmaster")

@section('product-edit')
<div class="main-container mt-4">
    <div class="pd-20 card-box mb-30">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-blue h4">Edit Product</h4>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">← Back</a>
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="form-group mb-3">
                <label>Product Code (Auto Generated)</label>
                <input type="text" class="form-control"
                       value="{{ $product->product_code }}" disabled>
            </div>

            <div class="form-group mb-3">
                <label>Product Name</label>
                <input name="name" type="text" class="form-control"
                       value="{{ $product->name }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Price</label>
                <input name="price" type="number" step="0.01" class="form-control"
                       value="{{ $product->price }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Stock</label>
                <input name="stock" type="number" class="form-control"
                       value="{{ $product->stock }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Select Category</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" 
                        {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Product Image</label>
                <input name="image" type="file" class="form-control">

                @if($product->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$product->image) }}"
                         width="80" height="80" style="object-fit:cover; border-radius:5px;">
                </div>
                @endif
            </div>

            <button class="btn btn-primary mt-3">Update Product</button>

        </form>
    </div>
</div>
@endsection
