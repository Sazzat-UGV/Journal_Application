@extends('Backend.layout.master')
@section('title')
    Change Password
@endsection
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Change Password',
        'main_page_name' => 'Dashboard',
        'sub_page_name' => 'Change Password',
        'main_page_url' => route('admin.dashboard'),
    ])
    <div class="card-body">
        <div class="row">
            <div class="col-md-10 col-lg-6">
                <form action="{{ route('admin.changepassword') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Old Password <span class="text-danger">*</span></label>
                        <input type="password" name="old_password"
                            class="form-control @error('old_password')
                is-invalid
                @enderror">
                        @error('old_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>New Password <span class="text-danger">*</span></label>
                        <input type="password" name="new_password"
                            class="form-control @error('new_password')
                is-invalid
                @enderror">
                        @error('new_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="confirm_password" class="form-control">
                    </div>

                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
