@extends('Frontend.layout.master')
@section('title')
    Change Password
@endsection
@push('user_style')
@endpush
@section('content')
<main class="container pt-3">
    <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-3"></div>
        <div class="col-sm-10 col-md-10 col-lg-6 pb-4">
            <div class="card py-2 bg-primary">
                <h5 class="text-white text-center">Change Password</h5>
            </div>
            <div class="card bg-light">
                <form class="text-start p-4" action="{{ route('user.changePassword') }}" method="POST">
                    @csrf

                        <div class="col-auto mb-4">
                            <label class="form-label text-start fw-bold" for="old_password">Old Password
                                <span class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control @error('old_password')
                            is-invalid
                        @enderror"
                                type="password" name="old_password" id="old_password" style="height: 50px !important;">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-auto mb-4">
                            <label class="form-label text-start fw-bold" for="new_password">New Password
                                <span class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control @error('new_password')
                            is-invalid
                        @enderror"
                                type="password" name="new_password" id="new_password" style="height: 50px !important;">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-auto mb-4">
                            <label class="form-label text-start fw-bold" for="confirm_password">Retype
                                Password <span class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control @error('confirm_password')
                            is-invalid
                        @enderror"
                                type="password" name="confirm_password" id="confirm_password"
                                style="height: 50px !important;">
                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="text-center mb-2">
                            <button type="submit" class="btn btn-primary me-4">Submit</button>
                            <button type="reset" class="btn btn-outline-primary">Clear</button>
                        </div>
                </form>
            </div>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-3"></div>
    </div>

</main>

@endsection
@push('user_script')
@endpush
