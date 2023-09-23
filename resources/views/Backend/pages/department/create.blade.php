@extends('Backend.layout.master')
@section('title')
    Create Department
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Create Department',
        'main_page_name' => 'Departments',
        'sub_page_name' => 'Create Department',
        'main_page_url' => route('department.index'),
    ])

    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 pb-3">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('department.index') }}" class="btn btn-primary me-4"><i
                                class="fas fa-arrow-alt-circle-left"></i>
                            Back to Departments</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <form action="{{ route('department.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Department Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter department name"
                            class="form-control @error('name')
            is-invalid
            @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Department Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}"
                            placeholder="Enter department full name"
                            class="form-control @error('full_name')
            is-invalid
            @enderror">
                        @error('full_name')
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
