@extends('Frontend.layout.master')
@section('title')
    Search Result
@endsection
@push('user_script')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row p-2 bg-light">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <div class="row mt-2">
                    <div class="col-lg-7 py-4">
                        <div class="align-items-center">
                            <form action="{{ route('home.searchGet') }}" method="POST">

                                @csrf
                                <div class="form-row align-items-center">
                                    <div class="col-md-9 col-8">
                                        <input class="form-control" type="text" name="search" id="search"
                                            placeholder="Enter Your Search Keyword" value="{{ $searchTerm }}" required />
                                    </div>
                                    <div class="col-md-3 col-4">
                                        <button type="submit" class="btn btn-success btn-block">
                                            Search
                                        </button>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-4">
            <div class="col-lg-3 pt-2 d-none d-lg-block">
                <div class="container">
                    <p class="pb-2 fs-4">
                        @if (isset($count))
                            {{ $count }} results
                        @else
                            0 results
                        @endif
                    </p>
                    <p>Refine by:</p>
                    <span>Years</span>
                    @if (isset($years))
                        @foreach ($years as $year)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $year }}" name="years[]"
                                    id="year-{{ $year }}">
                                <label class="form-check-label" for="year-{{ $year }}">{{ $year }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            </form>
            <div class="col-lg-6">
                @forelse ($searchResult as $result)
                    <div class="card mt-5">
                        <a href="{{ route('home.search_details', ['paper_id' => $result->id]) }}"
                            style="text-decoration: none; color: black; font-size: 15px">
                            <div class="card-body">
                                <p style="font-size: 12px; font-weight: 600; color: black">GENERIC OPEN ACCESS    @if (pathinfo($result->file, PATHINFO_EXTENSION) == 'zip')
                                    <span
                                                                            class="text-danger text-bold">ZIP</span>
                                @else
                                <span
                                class="text-danger text-bold">PDF</span>
                                @endif

                                    </p>
                                <h5 class="card-title">{{ $result->paper_title }}</h5>
                                <p class="card-text">
                                    {{ $result->author }}
                                </p>
                                <p class="card-text">
                                    {{ Str::limit($result->abstract, 195, '...') }}
                                </p>
                            </div>
                        </a>
                    </div>

                @empty
                    <div class=" mt-5">
                        <h5 class="e">No Result Found for this Keyword or is too short(at least 3 letters)</h5>
                    </div>
                    <div class="col-lg-3"></div>
                @endforelse
            </div>

        </div>
    </div>
@endsection
@push('user_script')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#showModalDiv").click(function() {
                console.log("Clicked on #showModalDiv");
                $("#myModal").modal("show");
            });
        });
    </script>
@endpush
