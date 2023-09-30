@extends('Frontend.layout.master')
@section('title')
    My Publications
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 80vh;
    overflow-x: auto;
}
    </style>
@endpush
@section('content')
    <main class="container-fluid pt-3">
        <div class="card px-5 bg-success">
            <h5 class="text-white text-center">You can see your publications here</h5>
        </div>
        <div class="table-responsive text-nowrap my-3">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Publish Date</th>
                        <th>Paper Title</th>
                        <th>Authors</th>
                        <th>Paper Area</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($papers as $index => $paper)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $paper->created_at->format('d-M-Y') }}</td>
                            <td>{{ Str::limit($paper->paper_title, 30, '...') }}</td>
                            <td>{{ $paper->author }}</td>
                            <td>{{ Str::limit($paper->category->category_name, 30, '...') }}</td>
                            <td>
                                <div class="actions">
                                    <a href="#" class="btn btn-sm bg-secondary-light border-dark mr-1"
                                        data-toggle="modal" data-target="#myModal-{{ $paper->id }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal-{{ $paper->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModal-{{ $paper->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-wrap" id="myModal-{{ $paper->id }}Label">Paper Details</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p><span class="text-info">Title: </span>{{ $paper->paper_title }}</p>
                                                        <p><span class="text-info">Paper Area: </span>{{ $paper->category->category_name }}</p>
                                                        <p><span class="text-info">Email: </span>{{ $paper->email }}</p>
                                                        <p><span class="text-info">Authors: </span>{{ $paper->author }}</p>
                                                        <p><span class="text-info">Abstract: </span>{{ $paper->abstract }}</p>
                                                    </div>
                                                </div>
                                                <a href="{{ route('user.userManagementshowPDF', ['user_id' => $paper->user_id, 'filename' => $paper->file]) }}"
                                                    class="btn btn-sm bg-secondary-light border-dark mr-1"
                                                    target="_blank">
                                                    Download
                                                </a>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
@push('user_script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                pagingType: 'first_last_numbers',
            });
        });
    </script>
@endpush
