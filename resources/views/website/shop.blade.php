@extends('Layouts.webmaster')

@section('shop-content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Filter by Category</span>
                </h5>

                <div class="bg-light p-4 mb-30">
             <form method="GET" action="{{ route('shop') }}">
    <div class="custom-control custom-checkbox mb-3">
        <input type="radio" name="category" value="" id="cat-all" class="custom-control-input" {{ request('category') == '' ? 'checked' : '' }}>
        <label class="custom-control-label" for="cat-all">All Categories</label>
    </div>

    @foreach ($allCategories as $cat)
        <div class="custom-control custom-checkbox mb-3">
            <input type="radio" name="category" value="{{ $cat->name }}" id="cat-{{ $cat->id }}" class="custom-control-input" {{ request('category') == $cat->name ? 'checked' : '' }}>
            <label class="custom-control-label" for="cat-{{ $cat->id }}">{{ $cat->name }}</label>
        </div>
    @endforeach

    <button class="btn btn-primary w-100 mt-3">Apply Filter</button>
</form>

                </div>



            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@foreach ($products as $item)
<div class="col-lg-4 col-md-6 col-sm-6 pb-1">

    <div class="product-item bg-light mb-4 position-relative" style="cursor:pointer;"
         onclick="window.location='{{ route('product.detail', $item->slug) }}'">

        <!-- Image -->
        <div class="product-img position-relative overflow-hidden">
            <img class="img-fluid w-100" src="{{ asset('storage/' . $item->image) }}" alt="">

            <div class="product-action">
                <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                    <button class="btn">
                        <a class="btn btn-outline-dark btn-square"><i class="fa fa-shopping-cart"></i></a>
                    </button>
                </form>

                <a class="btn btn-outline-dark btn-square"><i class="far fa-heart"></i></a>
                <a class="btn btn-outline-dark btn-square"><i class="fa fa-sync-alt"></i></a>
                <a class="btn btn-outline-dark btn-square"><i class="fa fa-search"></i></a>
            </div>
        </div>

        <!-- Text -->
        <div class="text-center py-4">
            <a class="h6 text-decoration-none text-truncate">{{ $item->title }}</a>

            <div class="mt-2">
                <h6>{{ $item->name }}</h6>
            </div>

            <div class="mt-2">
                <h5>{{ $item->price }} PKR</h5>
            </div>

            <div class="mt-2">
                <small class="text-muted">{{ $item->description }}</small>
            </div>

            <div class="mt-2">
                <small class="text-muted">{{ $item->category->name }}</small>
            </div>

            <div class="d-flex align-items-center justify-content-center mb-1">
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small>(99)</small>
            </div>
        </div>

    </div>

</div>
@endforeach

<div class="col-12 d-flex justify-content-center mt-3">
    {{ $products->links() }}
</div>



                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
