<ul class="menu-inner space-y-1 py-4">
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
        --orange-primary: #e8634b;
    }

    .menu-link {
        position: relative;
    }

    .menu-link:hover:not(.active) {
        background-color: rgba(232, 99, 75, 0.05);
    }
</style>
