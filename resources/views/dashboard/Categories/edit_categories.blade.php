@extends('Layouts.dashmaster')
@section('categoryCreate')
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Create Category</h4>

        </div>
    </div>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Name</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" placeholder="Category Name" name="name" value="{{ $category->name }}">
                @error('name')
                    <p style="color: red">Category Name is required</p>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Description</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" placeholder="Description" name="description" value="{{ $category->description }}">
                  @error('description')
                    <p style="color: red">Category description is required</p>
                @enderror
            </div>
        
           
</div>
<button type="submit" class="btn btn-primary">Update</button>
@endsection
