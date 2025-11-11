<ul class="menu-inner py-1">
    <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-grid-alt"></i>
            <div data-i18n="Analytics">{{ __('Main Menu') }}</div>
        </a>
    </li>

     <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('admin.users.index') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Users">{{ __('Users') }}</div>
            </a>
        </li>

     <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('admin.branches.index') ? 'active' : '' }}">
            <a href="{{ route('admin.branches.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Branch">{{ __('Branch') }}</div>
            </a>
        </li>

</ul>
