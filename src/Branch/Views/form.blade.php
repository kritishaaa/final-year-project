<x-layout.app header="User">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.branches.index') }}" class="btn btn-info"><i
                    class="bx bx-list-ul"></i>{{ __('Branch List') }}</a>
        </div>
        <div class="card-body">
            @if (isset($user))
                <livewire:branch.branch_form :$action :$user />
            @else
                <livewire:branch.branch_form :$action />
            @endif
        </div>
    </div>
</x-layout.app>
