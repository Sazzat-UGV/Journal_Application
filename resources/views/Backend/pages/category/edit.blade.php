@extends('Backend.layout.master')
@section('title')
    Edit Category
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Edit Category',
        'main_page_name' => 'Categories',
        'sub_page_name' => 'Edit Category',
        'main_page_url' => route('category.index'),
    ])

    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 pb-3">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('category.index') }}" class="btn btn-primary me-4"><i
                                class="fas fa-arrow-alt-circle-left"></i>
                            Back to Categories</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="category_name" value="{{ $category->category_name }}"
                            placeholder="Enter category name"
                            class="form-control @error('category_name')
            is-invalid
            @enderror">
                        @error('category_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
@endpush
