@extends('Backend.layout.master')
@section('title')
    Edit Profile
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Edit Profile',
        'main_page_name' => 'Dashboard',
        'sub_page_name' => 'Edit Profile',
        'main_page_url' => route('admin.dashboard'),
    ])

<div class="card-body">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.changeProfile', ['id' => Auth::user()->id])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                        class="form-control @error('name')
            is-invalid
            @enderror">
                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="{{ Auth::user()->email }}"
                        class="form-control @error('email')
            is-invalid
            @enderror">
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                        class="form-control @error('phone')
            is-invalid
            @enderror">
                    @error('phone')
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
