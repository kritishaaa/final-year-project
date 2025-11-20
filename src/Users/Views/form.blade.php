<x-layout.app header="User">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            {{-- <h5 class="text-primary fw-bold mb-0">
                {{ $action->value === 'create' ? __('Add Users' . ($selectedward ? ' for Ward ' . $selectedward : '')) : __(' update_user') }}
            </h5> --}}
            <a href="{{ route('admin.users.index') }}" class="btn btn-info"><i
                    class="bx bx-list-ul"></i>{{ __('User List') }}</a>
        </div>
        <div class="card-body">
            @if (isset($user))

                <livewire:users.user_form :$action :$user />
            @else
                <livewire:users.user_form :$action />
            @endif
        </div>
    </div>
</x-layout.app>
