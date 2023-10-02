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
                    <div class="card mt-5" id="showModalDiv" data-toggle="modal" data-target="#myModal-{{ $result->id }}">
                        <div class="card-body">
                            <p style="font-size: 12px; font-weight: 600; color: black">GENERIC OPEN ACCESS <span
                                    class="text-danger text-bold">PDF</span></p>
                            <h5 class="card-title">{{ $result->paper_title }}</h5>
                            <p class="card-text">
                                {{ $result->author }}
                            </p>
                            <p class="card-text">
                                {{ Str::limit($result->abstract, 195, '...') }}
                            </p>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal-{{ $result->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="myModal-{{ $result->id }}Label">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModal-{{ $result->id }}Label"></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <p style="font-size: 12px; font-weight: 600; color: black">GENERIC OPEN ACCESS
                                                <span class="text-danger text-bold">PDF</span></p>
                                            <h5 class="card-title">{{ $result->paper_title }}</h5>
                                            <p class="card-text">
                                                {{ $result->author }}
                                            </p>
                                            <a href="{{ route('user.userManagementshowPDF', ['user_id' => $result->user_id, 'filename' => $result->file]) }}"
                                                class="btn btn-sm bg-secondary-light border-dark mr-1" target="_blank">
                                                <i class="fas fa-file"></i> Download PDF
                                            </a>

                                            <hr>
                                            <p style="font-size: 14px;">ABSTRACT</p>
                                            <p class="card-text">
                                                {{ $result->abstract }}
                                            </p>
                                            <hr>
                                            <p><span style="font-weight: 600; color: black">Published by: </span><a
                                                    href="{{ route('home.publisherProfile', ['student_id' => $result->user->id]) }}">{{ $result->user->name }}</a>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
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
