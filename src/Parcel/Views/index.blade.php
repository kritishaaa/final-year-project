<x-layout.app header="Parcel List">

    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h5 class="text-primary fw-bold">{{ __('Parcels') }}</h5>
            <div>
                <a href="{{ route('admin.parcels.create') }}" class="btn btn-info"><i class="bx bx-plus"></i>
                    {{ __('Add Parcel') }}</a>

            </div>

        </div>
        <div class="card-body">
            <livewire:parcel.parcel_table theme="bootstrap-4" />
        </div>
    </div>
</x-layout.app>
