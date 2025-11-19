<x-layout.courier-app header="Assigned Parcels">

    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h5 class="text-primary fw-bold">{{ __('Assigned Parcels') }}</h5>


        </div>
        <div class="card-body">
            <livewire:courier.parcel.assignment_page theme="bootstrap-4" :$assignments />
        </div>
    </div>


</x-layout.courier-app>
