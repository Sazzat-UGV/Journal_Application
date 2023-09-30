@extends('Backend.layout.master')
@section('title')
    Admin Dashboard
@endsection
@section('content')
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{ Auth::user()->name }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card flex-fill fb sm-box">
                        <i class="fab fa-building"></i>
                        <h6>Departments</h6>
                        <p>{{ $department }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card flex-fill twitter sm-box">
                        <i class="fab fa-user-graduate"></i>
                        <h6>Semesters</h6>
                        <p>{{ $semester }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card flex-fill insta sm-box">
                        <i class="fab fa-user"></i>
                        <h6>Admins</h6>
                        <p>{{ $admin }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card flex-fill linkedin sm-box">
                        <i class="fab fa-user-cog"></i>
                        <h6>Users</h6>
                        <p>{{ $user }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card flex-fill fb sm-box">
                        <i class="fab fa-podcast"></i>
                        <h6>Publications</h6>
                        <p>{{ $publication }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card flex-fill twitter sm-box">
                        <i class="fab fa-list"></i>
                        <h6>Category</h6>
                        <p>{{ $category }}</p>
                    </div>
                </div>

            </div>

    @endsection
