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

                <h6>Departments</h6>
                <p>{{ $department }}</p>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card flex-fill twitter sm-box">
                <h6>Semesters</h6>
                <p>{{ $semester }}</p>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card flex-fill insta sm-box">

                <h6>Admins</h6>
                <p>{{ $admin }}</p>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card flex-fill linkedin sm-box">

                <h6>Users</h6>
                <p>{{ $user }}</p>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card flex-fill fb sm-box">

                <h6>Publications</h6>
                <p>{{ $publication }}</p>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card flex-fill twitter sm-box">

                <h6>Category</h6>
                <p>{{ $category }}</p>
            </div>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-12">
            <h5>Recent Registered</h5>
        </div>
    </div>
    <div class="table-responsive text-nowrap my-3">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Registered at</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Student ID</th>
                    <th>Department</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $user->created_at->format('d-M-Y') }}</td>
                        <td>{{ Str::limit($user->name, 15, '...') }}</td>
                        <td>{{ Str::limit($user->email, 15, '...') }}</td>
                        <td>{{ $user->student_id }}</td>
                        <td>{{ Str::limit($user->department->name, 15, '...') }}</td>
                        <td>{{ Str::limit($user->semester->semester_name, 10, '...') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
