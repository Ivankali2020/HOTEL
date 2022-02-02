<div class="app-sidebar sidebar-shadow">

    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading  ">Dashboards</li>

                <x-side-bar route="{{ route('home') }}" sidebarname="Dashboard" icon="pe-7s-display2 "  active="admin_home_active"/>
                <x-side-bar route="{{ route('features.index') }}" sidebarname="Create Features" icon="pe-7s-disk "  active="feature_index_active"/>

                <li class="app-sidebar__heading">User Manager</li>
                <x-side-bar route="{{ route('user.create') }}" sidebarname="Create User" icon="pe-7s-user "  active="user_create_active"/>
                <x-side-bar route="{{ route('user.index') }}" sidebarname="List User" icon="pe-7s-menu "  active="user_index_active"/>

                <li class="app-sidebar__heading">Room Manager</li>
                <x-side-bar route="{{ route('rooms.create') }}" sidebarname="Create Room" icon="pe-7s-magic-wand "  active="room_create_active"/>
                <x-side-bar route="{{ route('rooms.index') }}" sidebarname="Room List" icon=" pe-7s-home "  active="room_index_active"/>
{{--                <x-side-bar route="{{ route('serie.index') }}" sidebarname=" Series List" icon="pe-7s-menu "  active="serie_index_active"/>--}}
                <li class="app-sidebar__heading">Booking Manager</li>
                <x-side-bar route="{{ route('booking.index') }}" sidebarname="Booking List" icon="pe-7s-users "  active="booking_index_active"/>
                <x-side-bar route="{{ route('booking_confirm.index') }}" sidebarname="Confirmed List" icon="pe-7s-bookmarks "  active="confirm_booking_index_active"/>
                <x-side-bar route="{{ route('confirm_booking.serving') }}" sidebarname="Serving List" icon="pe-7s-server "  active="confirm_booking_server_active"/>

            </ul>
        </div>
    </div>
</div>

