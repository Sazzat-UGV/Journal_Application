@extends('Backend.layout.master')
@section('title')
    Edit Role
@endsection
@push('Role_style')
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Edit Role',
        'main_page_name' => 'System Role Settings',
        'sub_page_name' => 'Edit Role',
        'main_page_url' => route('role.index'),
    ])

    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 pb-3">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('role.index') }}" class="btn btn-primary me-4"><i
                                class="fas fa-arrow-alt-circle-left"></i>
                            Back to Roles</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Role Name <span class="text-danger">*</span></label>
                        <input type="text" name="role_name" value="{{ $role->role_name }}" placeholder="Enter role name"
                            class="form-control @error('role_name')
            is-invalid
            @enderror">
                        @error('role_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Role Note<span class="text-danger">*</span></label>
                        <input type="text" name="role_note" value="{{ $role->note }}" placeholder="Enter role note"
                            class="form-control @error('role_note')
            is-invalid
            @enderror">
                        @error('role_note')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mt-4 mb-2">
                        <strong
                            class="@error('permissions')
                            is-invalid
                            @enderror">Manage
                            Permissions for Role<span class="text-danger">*</span></strong>
                        @error('permissions')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="select-all">
                        <label class="form-check-label" for="defaultCheck1">Select All</label>
                    </div>

                    <div class="my-5">
                        @foreach ($modules->chunk(2) as $key => $chunks)
                            <div class="row">
                                @foreach ($chunks as $module)
                                    <div class="col mb-4">
                                        <h5 class="text-primary ">Module: {{ $module->module_name }}</h5>

                                        @foreach ($module->permissions as $permission)
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox"
                                                    id="permission-{{ $permission->id }}" name="permissions[]"
                                                    value="{{ $permission->id }}"
                                                    @if (isset($role)) @foreach ($role->permissions as $rpermission)
                                        {{ $rpermission->id == $permission->id ? 'checked' : '' }}
                                        @endforeach @endif>
                                                <label class="form-check-label"
                                                    for="permission-{{ $permission->id }}">{{ $permission->permission_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
    <script>
        //Listen for click on select all checkbox
        $('#select-all').click(function(event) {
            if (this.checked) {
                //loop each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                })
            } else {
                //loop each checkbox
                $(':checkbox').each(function() {
                    this.checked = false;
                })
            }
        });
    </script>
@endpush
