<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class=" active">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-user-graduate"></i> <span>
                            Dashboard</span></a>
                </li>

                @can('index-admin')
                    <li class="submenu">
                        <a href="#"><i class="fas fa-user-alt"></i> <span> System Admin Settings</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('systemadmin.index') }}">Admin List</a></li>
                            @can('create-admin')
                                <li><a href="{{ route('systemadmin.create') }}">Add New Admin</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('index-role')
                    <li class="submenu">
                        <a href="#"><i class="fas fa-user-edit"></i> <span> System Role Settings</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('role.index') }}">Role List</a></li>
                            @can('create-role')
                                <li><a href="{{ route('role.create') }}">Add New Role</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('index-department')
                    <li class="submenu">
                        <a href="#"><i class="fas fa-building"></i> <span> Departments</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('department.index') }}">Department List</a></li>
                            @can('create-department')
                                <li><a href="{{ route('department.create') }}">Add New Department</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('index-semester')
                    <li class="submenu">
                        <a href="#"><i class="fas fa-graduation-cap"></i> <span> Semesters</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('semester.index') }}">Semester List</a></li>
                            @can('create-semester')
                                <li><a href="{{ route('semester.create') }}">Add New Semester</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('index-user')
                    <li class="">
                        <a href="{{ route('admin.userManagementIndex') }}"><i class="fas fa-user-cog"></i> <span>
                                User Managements</span></a>
                    </li>
                @endcan

                @can('mail-setting')
                    <li class="submenu">
                        <a href="#"><i class="fas fa-cog"></i> <span> System Settings</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            @can('mail-setting')
                                <li><a href="{{ route('admin.mailSettingPage') }}">Mail Setting</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan


            </ul>
        </div>
    </div>
</div>
