@extends('Backend.layout.master')
@section('title')
    Change Password
@endsection
@section('content')
    <div class="card-body">
        <h5 class="card-title">Change Password</h5>
        <div class="row">
            <div class="col-md-10 col-lg-6">
                <form action="{{ route('admin.changepassword') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" name="old_password"
                            class="form-control @error('old_password')
                is-invalid
                @enderror">
                        @error('old_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password"
                            class="form-control @error('new_password')
                is-invalid
                @enderror">
                        @error('new_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                    </div>

                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
