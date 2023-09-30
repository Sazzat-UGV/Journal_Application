@extends('Frontend.layout.master')
@section('title')
    Publish Paper
@endsection
@push('user_style')
@endpush
@section('content')
    <main class="container pt-5">
        <div class="pb-2 mb-3">
            <div class="container" style="width: 600px !important;">
                <div class="card py-2 px-5 bg-success">
                    <h5 class="text-white text-center">Publish New Paper</h5>
                </div>
                <div class="card bg-light">
                    <form class="text-start p-5" action="{{ route('user.PublicationStore') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="container">

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="paper_title">Paper Title
                                    <span class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('paper_title')
                                is-invalid
                            @enderror" value="{{old('paper_title')}}"
                                    type="text" name="paper_title" id="paper_title" placeholder="Enter paper title"
                                    style="height: 50px !important;">
                                @error('paper_title')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="author">Author
                                    <span class="text-danger fw-normal">*</span> </label>
                                <input
                                    class="form-control px-4 @error('author')
                                is-invalid
                            @enderror"
                                    type="text" value="{{old('author')}}" name="author" id="author" placeholder="Enter authors name"
                                    style="height: 50px !important;">
                                @error('author')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                                <label class="form-label text-start text-warning fw-bold" style="font-size: 13px">Comma
                                    Separated List of Authors (FName LName,FName LName)</label>
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="email">Email
                                    <span class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('email')
                                is-invalid
                            @enderror"
                                    type="email"  name="email" id="email" placeholder="Enter your email"
                                    value="{{ old('email') }}" style="height: 50px !important;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="abstract">Abstract
                                    <span class="text-danger fw-normal">*</span></label>
                                <textarea name="abstract" id="abstract" cols="30" rows="5"  placeholder="Type your abstract here"
                                    class="form-control @error('abstract')
                                    is-invalid
                                @enderror">{{old('abstract')}}
                            </textarea>

                                @error('abstract')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="paper_area">Select Paper Area
                                    <span class="text-danger fw-normal">*</span></label>
                                <select
                                    class="form-select @error('paper_area')
                                is-invalid
                            @enderror"
                                    aria-label="Default select example" name="paper_area">
                                    <option>Select Option</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('paper_area')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="file_upload">Attach Paper
                                    <span class="text-danger fw-normal">*</span></label>
                                <input type="file" value="{{old('file')}}"
                                    class="form-control @error('file_upload')
                                    is-invalid
                                @enderror"
                                    id="file_upload" name="file_upload">
                                @error('file_upload')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="text-center mb-2">
                                <button type="submit" class="btn btn-success me-4">Submit</button>
                                <button type="reset" class="btn btn-outline-success">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('user_script')
@endpush
