@extends('Backend.layout.master')
@section('title')
    Mail Setting
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'main_page_name' => 'Dashboard',
        'main_page_url' => route('admin.dashboard'),
        'page_name' => 'Mail Setting',
        'sub_page_name' => 'Mail Setting',
    ])


    <div class="card-body">
        <div class="row">

            <div class="col-12">
                <form action="{{ route('admin.mailSetting') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>MAIL MAILER<span class="text-danger">*</span></label>
                        <input type="text" name="mail_mailer" value="{{ setting('mail_mailer') }}"
                            placeholder="Enter mail mailer"
                            class="form-control @error('mail_mailer')
        is-invalid
        @enderror">
                        @error('mail_mailer')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>MAIL HOST<span class="text-danger">*</span></label>
                        <input type="text" name="mail_host" value="{{ setting('mail_host') }}"
                            placeholder="Enter mail host"
                            class="form-control @error('mail_host')
        is-invalid
        @enderror">
                        @error('mail_host')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>MAIL PORT<span class="text-danger">*</span></label>
                        <input type="text" name="mail_port" value="{{ setting('mail_port') }}"
                            placeholder="Enter mail port"
                            class="form-control @error('mail_port')
        is-invalid
        @enderror">
                        @error('mail_port')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>MAIL USERNSME<span class="text-danger">*</span></label>
                        <input type="text" name="mail_username" value="{{ setting('mail_username') }}"
                            placeholder="Enter mail username"
                            class="form-control @error('mail_username')
        is-invalid
        @enderror">
                        @error('mail_username')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>MAIL PASSWORD<span class="text-danger">*</span></label>
                        <input type="text" name="mail_password" value="{{ setting('mail_password') }}"
                            placeholder="Enter mail password"
                            class="form-control @error('mail_password')
        is-invalid
        @enderror">
                        @error('mail_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>MAIL ENCRYPTION<span class="text-danger">*</span></label>
                        <input type="text" name="mail_encryption" value="{{ setting('mail_encryption') }}"
                            placeholder="Enter mail encryption"
                            class="form-control @error('mail_encryption')
        is-invalid
        @enderror">
                        @error('mail_encryption')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>MAIL FROM ADDRESS<span class="text-danger">*</span></label>
                        <input type="text" name="mail_from_address" value="{{ setting('mail_from_address') }}"
                            placeholder="Enter mail from address"
                            class="form-control @error('mail_from_address')
        is-invalid
        @enderror">
                        @error('mail_from_address')
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
