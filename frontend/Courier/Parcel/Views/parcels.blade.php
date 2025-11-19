<x-layout.courier-app header="Parcel List">

    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h4 class="text-primary fw-bold">{{ __('All Available Parcels of Your Branch') }}</h4>


        </div>
        <div class="card-body">
            <livewire:courier.parcel.parcel_page theme="bootstrap-4" />
        </div>
    </div>




</x-layout.courier-app>
