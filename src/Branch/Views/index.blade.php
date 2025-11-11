<x-layout.app header="Branch List">

    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h5 class="text-primary fw-bold">{{ __('Branches') }}</h5>
            <div>
                <a href="{{ route('admin.branches.create') }}" class="btn btn-info"><i class="bx bx-plus"></i>
                    {{ __('Add Branches') }}</a>

            </div>

        </div>
        <div class="card-body">
            <livewire:branch.branch_table theme="bootstrap-4" />
        </div>
    </div>
</x-layout.app>
