<x-layout.app header="Courier">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.couriers.index') }}" class="btn btn-info"><i
                    class="bx bx-list-ul"></i>{{ __('Courier List') }}</a>
        </div>
        <div class="card-body">
            @if (isset($courier))
                <livewire:courier.courier_form :$action :$courier />
            @else
                <livewire:courier.courier_form :$action />
            @endif
        </div>
    </div>
</x-layout.app>
