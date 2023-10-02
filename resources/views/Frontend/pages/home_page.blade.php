@extends('Frontend.layout.master')
@section('title')
    UGV Journals
@endsection
@push('user_style')
@endpush
@section('content')
    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <h2 class="text-white mt-4 mb-4">Welcome to UGV Journal</h2>
            <h3 class="text-white mb-5">Search for and add articles to your library</h3>
            <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
                <form action="{{ route('home.search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" class="form-control border-light" style="padding: 30px 25px;"
                            placeholder="Keyword">
                        <div class="input-group-append">
                            <button class="btn btn-secondary px-4 px-lg-5">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('user_script')
@endpush
