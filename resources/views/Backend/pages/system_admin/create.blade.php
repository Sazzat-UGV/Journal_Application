@extends('Backend.layout.master')
@section('title')
    Create Admin
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Create Admin',
        'main_page_name' => 'System Admin Settings',
        'sub_page_name' => 'Create Admin',
        'main_page_url' => route('systemadmin.index'),
    ])

    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 pb-3">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('systemadmin.index') }}" class="btn btn-primary me-4"><i
                                class="fas fa-arrow-alt-circle-left"></i>
                            Back to Index</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <form action="{{ route('systemadmin.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Select Role <span class="text-danger">*</span></label>
                        <select class="custom-select @error('role_id') is-invalid @enderror" name="role_id">
                            <option value="">Select a role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->role_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Admin Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter admin name"
                            class="form-control @error('name')
            is-invalid
            @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Admin Email <span class="text-danger">*</span></label>
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="Enter admin email"
                            class="form-control @error('email')
            is-invalid
            @enderror">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Admin Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" value="{{ old('password') }}" placeholder="Enter admin password"
                            class="form-control @error('password')
            is-invalid
            @enderror">
                        @error('password')
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
