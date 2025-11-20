<ul class="nav flex-column py-4" style="background-color: #2f3a3f; min-height: 100vh;">

    @php
        $menuItems = [
            ['route' => 'admin.dashboard', 'icon' => 'fa fa-tachometer-alt', 'label' => 'Dashboard'],
            ['route' => 'admin.users.index', 'icon' => 'fa fa-user', 'label' => 'Users'],
            ['route' => 'admin.branches.index', 'icon' => 'fa fa-building', 'label' => 'Branches'],
            ['route' => 'admin.couriers.index', 'icon' => 'fa fa-car', 'label' => 'Couriers'],
            ['route' => 'admin.parcels.index', 'icon' => 'fa fa-box', 'label' => 'Parcels'],
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
