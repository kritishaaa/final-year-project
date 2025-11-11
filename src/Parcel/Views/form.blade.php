<x-layout.app header="Parcel">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.parcels.index') }}" class="btn btn-info"><i
                    class="bx bx-list-ul"></i>{{ __('Parcel List') }}</a>
        </div>
        <div class="card-body">
            @if (isset($parcel))
                <livewire:parcel.parcel_form :$action :$parcel />
            @else
                <livewire:parcel.parcel_form :$action />
            @endif
        </div>
    </div>
</x-layout.app>
