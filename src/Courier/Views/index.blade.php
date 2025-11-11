<x-layout.app header="Courier List">

    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h5 class="text-primary fw-bold">{{ __('Couriers') }}</h5>
            <div>
                <a href="{{ route('admin.couriers.create') }}" class="btn btn-info"><i class="bx bx-plus"></i>
                    {{ __('Add courier') }}</a>

            </div>

        </div>
        <div class="card-body">
            <livewire:courier.courier_table theme="bootstrap-4" />
        </div>
    </div>
</x-layout.app>
