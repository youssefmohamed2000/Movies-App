<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar"
             src="{{ auth()->user()->image_path }}" alt="User Image" width="60" height="60"
        >
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->type }}</p>
        </div>
    </div>
    <ul class="app-menu">
        {{--home--}}
        <li>
            <a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}"
               href="{{ route('admin.home') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Home</span>
            </a>
        </li>

        {{--roles--}}
        @can('read_roles')
            <li>
                <a class="app-menu__item {{ request()->is('*roles*') ? 'active' : '' }}"
                   href="{{ route('admin.roles.index') }}"><i class="app-menu__icon fa fa-lock"></i>
                    <span class="app-menu__label">Roles</span>
                </a>
            </li>
        @endcan

        {{--admins--}}
        @can('read_admins')
            <li>
                <a class="app-menu__item {{ request()->is('*admins*') ? 'active' : '' }}"
                   href="{{ route('admin.admins.index') }}"><i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">Admins</span>
                </a>
            </li>
        @endcan

        {{--users--}}
        @can('read_users')
            <li>
                <a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}"
                   href="{{ route('admin.users.index') }}"><i class="app-menu__icon fa fa-user"></i>
                    <span class="app-menu__label">Users</span>
                </a>
            </li>
        @endcan

        {{--genres--}}
        @can('read_genres')
            <li>
                <a class="app-menu__item {{ request()->is('*genres*') ? 'active' : '' }}"
                   href="{{ route('admin.genres.index') }}"><i class="app-menu__icon fa fa-list"></i>
                    <span class="app-menu__label">Genres</span>
                </a>
            </li>
        @endcan

        {{--movies--}}
        @can('read_movies')
            <li>
                <a class="app-menu__item {{ request()->is('*movies*') ? 'active' : '' }}"
                   href="{{ route('admin.movies.index') }}"><i class="app-menu__icon fa fa-film"></i>
                    <span class="app-menu__label">Movies</span>
                </a>
            </li>
        @endcan

        {{--actors--}}
        @can('read_actors')
            <li>
                <a class="app-menu__item {{ request()->is('*actors*') ? 'active' : '' }}"
                   href="{{ route('admin.actors.index') }}"><i class="app-menu__icon fa fa-address-book-o"></i>
                    <span class="app-menu__label">Actors</span>
                </a>
            </li>
        @endcan

        {{--settings--}}
        @can('read_settings')
            <li class="treeview {{ request()->is('*settings*') ? 'is-expanded' : '' }}">
                <a class="app-menu__item" href="#"
                   data-toggle="treeview">
                    <i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Settings</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="{{ route('admin.settings.general') }}">
                            <i class="icon fa fa-circle-o"></i>General
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        {{--profile--}}
        <li class="treeview {{ request()->is('*profile*') ? 'is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-user-circle"></i>
                <span class="app-menu__label">Profile</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="{{ route('admin.profile.edit') }}">
                        <i class="icon fa fa-circle-o"></i>Edit Profile
                    </a>
                </li>
                <li>
                    <a class="treeview-item" href="{{ route('admin.profile.password.edit') }}">
                        <i class="icon fa fa-circle-o"></i> Change Password
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
