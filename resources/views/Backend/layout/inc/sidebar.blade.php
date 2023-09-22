<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu active">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-user-graduate"></i> <span>
                            Dashboard</span></a>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-user-alt"></i> <span> System Admin Settings</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('systemadmin.index') }}">Admin List</a></li>
                        <li><a href="{{ route('systemadmin.create') }}">Add New Admin</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-user-edit"></i> <span> System Role Settings</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('role.index') }}">Role List</a></li>
                        <li><a href="{{ route('role.create') }}">Add New Role</a></li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
</div>
