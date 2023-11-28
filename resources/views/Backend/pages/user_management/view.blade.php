@extends('Backend.layout.master')

@section('title')
    User Profile
@endsection

@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'main_page_name' => 'User Managements',
        'main_page_url' => route('admin.userManagementIndex'),
        'page_name' => 'User Profile',
        'sub_page_name' => 'User Profile',
    ])

    <div class="row">
        <div class="col-md-12">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-auto profile-image">
                        <a href="#">
                            <img class="rounded-circle" alt="User Image"
                                src="{{ asset('uploads/user') }}/{{ $user->image }}">
                        </a>
                    </div>
                    <div class="col ml-md-n2 profile-user-info">
                        <h4 class="user-name mb-0">{{ $user->name }}</h4>
                        <h6 class="text-muted">{{ $user->role->role_name }}</h6>
                    </div>
                </div>
            </div>


            <div class="profile-menu">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
                    </li>
                    @can('view-user-publications')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#publications">Publications</a>
                        </li>
                    @endcan
                </ul>
            </div>

            <div class="tab-content profile-tab-cont">
                <div class="tab-pane fade show active" id="per_details_tab">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                        <p class="col-sm-9">{{ $user->name }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Student Id</p>
                                        <p class="col-sm-9">{{ $user->student_id }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                        <p class="col-sm-9">{{ $user->email }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                        <p class="col-sm-9">{{ $user->phone }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Address</p>
                                        <p class="col-sm-9">{{ $user->address }}</p>
                                    </div>

                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Department</p>
                                        <p class="col-sm-9">{{ $user->department->full_name }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Semester</p>
                                        <p class="col-sm-9">{{ $user->semester->semester_name }}</p>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Account Status</span>
                                    </h5>
                                    <span><i class="fe fe-check-verified"></i>

                                        @if ($user->is_active == 1)
                                            <span class="btn btn-success">Active</span>
                                        @else
                                            <span class="btn btn-danger">Deactive</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <span>Followed By: {{ $follower }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                @can('view-user-publications')
                    <div id="publications" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Publications</h5>
                                <div class="row">
                                    <div class="col-md-10 col-lg-12">
                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Publish Date</th>
                                                    <th>Paper Title</th>
                                                    <th>Paper Area</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($papers as $index => $paper)
                                                    <tr>
                                                        <th scope="row">{{ $index + 1 }}</th>
                                                        <td>{{ $paper->created_at->format('d-M-Y') }}</td>
                                                        <td>{{ $paper->paper_title }}</td>
                                                        <td>{{ $paper->category->category_name }}</td>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#"
                                                                    class="btn btn-sm bg-secondary-light border-dark mr-1"
                                                                    data-toggle="modal"
                                                                    data-target="#myModal-{{ $paper->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="myModal-{{ $paper->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModal-{{ $paper->id }}Label"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="myModal-{{ $paper->id }}Label">Paper
                                                                                Details</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12">
                                                                                <p><span class="text-success">Title:
                                                                                    </span>{{ $paper->paper_title }}</p>
                                                                                <p><span class="text-success">Paper Area:
                                                                                    </span>{{ $paper->category->category_name }}
                                                                                </p>
                                                                                <p><span class="text-success">Type:
                                                                                    </span>{{ $paper->publication_type }}
                                                                                </p>
                                                                                <p><span class="text-success">Email:
                                                                                    </span>{{ $paper->email }}</p>
                                                                                <p><span class="text-success">DOI:
                                                                                    </span><a href="https://dx.doi.org/{{ $paper->doi }}"
                                                                                        target="blank">{{ $paper->doi }}</a></p>
                                                                                <p><span class="text-success">Authors:
                                                                                    </span>{{ $paper->author }}</p>
                                                                                <p><span class="text-success">Abstract:
                                                                                    </span>{{ $paper->abstract }}</p>
                                                                                    @if (isset($paper->image))
                                                                                    <p><img src="{{ asset('uploads/paper') }}/{{ $paper->image }}"
                                                                                     alt="Image"
                                                                                     class="img-fluid w-75 text-center" /></p>
                                                                                    @endif
                                                                                <a href="{{ route('admin.userManagementshowPDF', ['user_id' => $paper->user_id, 'filename' => $paper->file]) }}"
                                                                                    class="btn btn-sm bg-secondary-light border-dark mr-1"
                                                                                    target="_blank">
                                                                                    Download
                                                                                </a>
                                                                            </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            @endsection

            @push('admin_script')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
                    integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

                <script>
                    $('.dropify').dropify();
                </script>
            @endpush
