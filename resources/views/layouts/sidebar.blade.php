<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">VENOM IPTV</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="{{ request()->routeIs('dashboard') ? 'mm-active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">IPTV Management</div>
            </a>
            <ul>
                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Channels</a>
                </li>
                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Streams</a>
                </li>
                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Categories</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-group"></i>
                </div>
                <div class="menu-title">Users & Access</div>
            </a>
            <ul>
                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Users</a>
                </li>
                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Resellers</a>
                </li>
                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Access Control</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cog"></i>
                </div>
                <div class="menu-title">System</div>
            </a>
            <ul>
                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Servers</a>
                </li>
                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Settings</a>
                </li>
                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Logs</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">System Management</li>
        <li class="{{ request()->routeIs('profile') ? 'mm-active' : '' }}">
            <a href="{{ route('profile') }}">
                <div class="parent-icon"><i class='bx bx-user-circle'></i>
                </div>
                <div class="menu-title">Profile</div>
            </a>
        </li>
        <li class="{{ request()->routeIs('settings') ? 'mm-active' : '' }}">
            <a href="{{ route('settings') }}">
                <div class="parent-icon"><i class='bx bx-cog'></i>
                </div>
                <div class="menu-title">Settings</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="parent-icon"><i class='bx bx-log-out-circle'></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->