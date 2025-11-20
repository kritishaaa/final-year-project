{{-- <ul class="menu-inner space-y-1 py-4">
    <li class="menu-item">
        <a href="{{ route('courier.dashboard') }}"
            class="menu-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ \Illuminate\Support\Facades\Route::is('admin.dashboard') ? 'bg-orange-50 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="menu-icon bx bx-grid-alt text-lg"></i>
            <div class="font-medium text-sm">{{ __('Dashboard') }}</div>
            @if (\Illuminate\Support\Facades\Route::is('courier.dashboard'))
                <span class="ml-auto w-2 h-2 bg-orange-500 rounded-full"></span>
            @endif
        </a>
        <a href="{{ route('courier.parcels.index') }}"
            class="menu-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ \Illuminate\Support\Facades\Route::is('admin.dashboard') ? 'bg-orange-50 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="menu-icon bx bx-grid-alt text-lg"></i>
            <div class="font-medium text-sm">{{ __('All Parcels') }}</div>
            @if (\Illuminate\Support\Facades\Route::is('courier.parcels.index'))
                <span class="ml-auto w-2 h-2 bg-orange-500 rounded-full"></span>
            @endif
        </a>
        <a href="{{ route('courier.parcels.assign') }}"
            class="menu-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ \Illuminate\Support\Facades\Route::is('admin.dashboard') ? 'bg-orange-50 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="menu-icon bx bx-grid-alt text-lg"></i>
            <div class="font-medium text-sm">{{ __('Assigned Parcels') }}</div>
            @if (\Illuminate\Support\Facades\Route::is('courier.parcels.assign'))
                <span class="ml-auto w-2 h-2 bg-orange-500 rounded-full"></span>
            @endif
        </a>
    </li>


</ul>

<style>
    :root {
        --orange-primary: #e3a37e;
    }

    .menu-link {
        position: relative;
    }

    .menu-link:hover:not(.active) {
        background-color: rgba(232, 99, 75, 0.05);
    }
</style> --}}


<ul class="nav flex-column py-4" style="background-color: #2f3a3f; min-height: 100vh;">

    @php
        $menuItems = [
            ['route' => 'courier.dashboard', 'icon' => 'fa fa-tachometer-alt', 'label' => 'Dashboard'],
            ['route' => 'courier.parcels.index', 'icon' => 'fa fa-box', 'label' => 'All Parcels'],
            ['route' => 'courier.parcels.assign', 'icon' => 'fa fa-building', 'label' => 'Assigned Parcels'],
        ];
    @endphp

    @foreach ($menuItems as $item)
        @php
            $isActive = \Illuminate\Support\Facades\Route::is($item['route']);
        @endphp
        <li class="nav-item">
            <a href="{{ route($item['route']) }}"
                class="nav-link d-flex align-items-center gap-2 px-4 py-3 rounded {{ $isActive ? 'active-link' : 'text-light' }}"
                style="
                    font-weight: 600; 
                    color: {{ $isActive ? '#2f3a3f' : '#fffdfa' }};
                    background-color: {{ $isActive ? '#e3a37e' : 'transparent' }};
                    transition: all 0.2s ease-in-out;
               ">
                <i class="{{ $item['icon'] }} fs-5" style="color: {{ $isActive ? '#2f3a3f' : '#d8a04b' }};"></i>
                <span class="fw-semibold ms-2">{{ __($item['label']) }}</span>
            </a>
        </li>
    @endforeach
    <li class="nav-item sidebar-footer">
        <hr>
        <div class="user-info d-flex flex-column align-items-center text-light" style="font-size: 15px;">
            <span class="fw-bold">{{ auth()->user()->name }}</span>
            <small class="text-muted">{{ auth()->user()->email }}</small>
        </div>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <button type="button"
            class="btn btn-sm btn-outline-light mt-2 w-100 d-flex align-items-center justify-content-center"
            onclick="document.getElementById('logout-form').submit()">
            <i class="bx bx-power-off me-2"></i> {{ __('Log Out') }}
        </button>
    </li>
</ul>
<style>
    .nav-link:hover {
        background-color: #3a4750 !important;
        color: #d8a04b !important;
    }

    .nav-link:hover i {
        color: #d8a04b !important;
    }

    .sidebar-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1rem;
        /* Adjust as needed */
        /* Use the brand colors for muted text */
        color: rgba(255, 255, 255, 0.5) !important;
    }
</style>
