<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)  != 'dashboard') collapse @endif" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link @if(Request::segment(2)  != 'user') collapse @endif " href="{{ route('user.index') }}">
                        <i class="bi bi-person"></i>
                        <span>User</span>
                    </a>
                </li><!-- End Profile Page Nav -->

                <li class="nav-item">
                    <a class="nav-link @if(Request::segment(2)  != 'role') collapse @endif " href="{{ route('role.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Roles </span>
                    </a>
                </li><!-- End Profile Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#">
                        <i class="bi bi-person"></i>
                        <span>Permission</span>
                    </a>
                </li><!-- End Profile Page Nav -->

                <li class="nav-item">
                    <a class="nav-link @if(Request::segment(2)  != 'setting') collapse @endif " href="#">
                        <i class="bi bi-person"></i>
                        <span>Setting </span>
                    </a>
                </li><!-- End Profile Page Nav -->

            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Pages</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link @if(Request::segment(2)  != 'category') collapse @endif " href="#">
                        <i class="bi bi-person"></i>
                        <span>Category</span>
                    </a>
                </li><!-- End Profile Page Nav -->

                <li class="nav-item">
                    <a class="nav-link @if(Request::segment(2)  != 'subcategory') collapse @endif " href="{{ route('role.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Sub Category </span>
                    </a>
                </li><!-- End Profile Page Nav -->

                <li class="nav-item">
                    <a class="nav-link @if(Request::segment(2)  != 'product') collapse @endif " href="{{ route('role.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Product </span>
                    </a>
                </li><!-- End Profile Page Nav -->
            </ul>
        </li><!-- End Components Nav -->

    </ul>

</aside><!-- End Sidebar-->
