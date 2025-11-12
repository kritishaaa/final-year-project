<x-layout.app header="Parcel List">
    <div class="container-fluid p-4">
        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1 fw-bold text-dark">Parcel Details</h3>
                <p class="text-muted mb-0">Complete information about this parcel</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.parcels.edit', $parcel->id) }}" class="btn btn-primary rounded-3">
                    <i class="bx bx-edit-alt me-1"></i> Edit Parcel
                </a>
                <a href="{{ route('admin.parcels.index') }}" class="btn btn-outline-secondary rounded-3">
                    <i class="bx bx-arrow-back me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="row g-4">
            {{-- Left Column --}}
            <div class="col-lg-8">

                {{-- Tracking & Status Card --}}
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-2 fw-semibold">Tracking Information</h5>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-barcode fs-1 text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Tracking Code</small>
                                        <h4 class="mb-0 fw-bold text-primary">{{ $parcel->tracking_code }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <small class="text-muted d-block mb-2">Current Status</small>
                                <span
                                    class="badge rounded-pill fs-6 px-4 py-2 
                                {{ $parcel->status === 'delivered' ? 'bg-success' : '' }}
                                {{ $parcel->status === 'in_transit' ? 'bg-info' : '' }}
                                {{ $parcel->status === 'pending' ? 'bg-warning text-dark' : '' }}
                                {{ $parcel->status === 'cancelled' ? 'bg-danger' : '' }}">
                                    <i
                                        class="bx 
                                    {{ $parcel->status === 'delivered' ? 'bx-check-circle' : '' }}
                                    {{ $parcel->status === 'in_transit' ? 'bx-loader-circle' : '' }}
                                    {{ $parcel->status === 'pending' ? 'bx-time' : '' }}
                                    {{ $parcel->status === 'cancelled' ? 'bx-x-circle' : '' }} me-1"></i>
                                    {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                                </span>
                                <div class="mt-3">
                                    <small class="text-muted d-block">Created</small>
                                    <strong>{{ $parcel->created_at->format('M d, Y h:i A') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sender & Recipient Cards --}}
                <div class="row g-4 mb-4">
                    {{-- Sender Card --}}
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-header bg-transparent border-0 pt-4 px-4">
                                <h5 class="fw-semibold text-primary mb-0">
                                    <i class="bx bx-user me-2"></i>Sender Information
                                </h5>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <div class="mb-3">
                                    <small class="text-muted d-block mb-1">Name</small>
                                    <p class="mb-0 fw-semibold">{{ $parcel->sender_name }}</p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block mb-1">Contact</small>
                                    <p class="mb-0">
                                        <i class="bx bx-phone me-1 text-primary"></i>
                                        {{ $parcel->sender_contact }}
                                    </p>
                                </div>
                                <div>
                                    <small class="text-muted d-block mb-1">Address</small>
                                    <p class="mb-0">
                                        <i class="bx bx-map me-1 text-primary"></i>
                                        {{ $parcel->sender_address }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Recipient Card --}}
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-header bg-transparent border-0 pt-4 px-4">
                                <h5 class="fw-semibold text-success mb-0">
                                    <i class="bx bx-map-pin me-2"></i>Recipient Information
                                </h5>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <div class="mb-3">
                                    <small class="text-muted d-block mb-1">Name</small>
                                    <p class="mb-0 fw-semibold">{{ $parcel->recipient_name }}</p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block mb-1">Contact</small>
                                    <p class="mb-0">
                                        <i class="bx bx-phone me-1 text-success"></i>
                                        {{ $parcel->recipient_contact }}
                                    </p>
                                </div>
                                <div>
                                    <small class="text-muted d-block mb-1">Address</small>
                                    <p class="mb-0">
                                        <i class="bx bx-map me-1 text-success"></i>
                                        {{ $parcel->recipient_address }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Route & Branch Information --}}
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="fw-semibold mb-0">
                            <i class="bx bx-route me-2 text-primary"></i>Route Information
                        </h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="d-flex align-items-center justify-content-between position-relative py-3">
                            {{-- Route Line --}}
                            <div class="position-absolute top-50 start-0 end-0 translate-middle-y"
                                style="height: 3px; background: linear-gradient(to right, #0d6efd 0%, #198754 100%); z-index: 0;">
                            </div>

                            {{-- From Branch --}}
                            <div class="text-center position-relative" style="z-index: 1; flex: 1;">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 60px; height: 60px; box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);">
                                    <i class="bx bx-store fs-3"></i>
                                </div>
                                <small class="text-muted d-block mb-1">Origin Branch</small>
                                <strong class="d-block">{{ $parcel->fromBranch->name ?? 'N/A' }}</strong>
                                @if ($parcel->fromBranch)
                                    <small class="text-muted">{{ $parcel->fromBranch->city ?? '' }}</small>
                                @endif
                            </div>

                            {{-- Distance Indicator --}}
                            <div class="text-center position-relative mx-4" style="z-index: 1;">
                                <div class="bg-light border rounded-3 px-3 py-2">
                                    <i class="bx bx-trip text-primary fs-4"></i>
                                    <div class="mt-1">
                                        <strong class="d-block text-primary">{{ number_format($parcel->distance, 2) }}
                                            km</strong>
                                        <small class="text-muted">Distance</small>
                                    </div>
                                </div>
                            </div>

                            {{-- To Branch --}}
                            <div class="text-center position-relative" style="z-index: 1; flex: 1;">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 60px; height: 60px; box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);">
                                    <i class="bx bx-store fs-3"></i>
                                </div>
                                <small class="text-muted d-block mb-1">Destination Branch</small>
                                <strong class="d-block">{{ $parcel->toBranch->name ?? 'N/A' }}</strong>
                                @if ($parcel->toBranch)
                                    <small class="text-muted">{{ $parcel->toBranch->city ?? '' }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Additional Information --}}
                @if ($parcel->remarks)
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <h5 class="fw-semibold mb-0">
                                <i class="bx bx-note me-2 text-primary"></i>Additional Remarks
                            </h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <p class="mb-0 text-muted">{{ $parcel->remarks }}</p>
                        </div>
                    </div>
                @endif

            </div>

            {{-- Right Column --}}
            <div class="col-lg-4">



                {{-- Parcel Details Card --}}
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="fw-semibold mb-0">
                            <i class="bx bx-package me-2 text-primary"></i>Parcel Details
                        </h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="mb-3 pb-3 border-bottom">
                            <small class="text-muted d-block mb-1">Weight</small>
                            <p class="mb-0">
                                <i class="bx bx-box me-2 text-primary"></i>
                                <strong>{{ number_format($parcel->weight, 2) }} kg</strong>
                            </p>
                        </div>

                        <div class="mb-3 pb-3 border-bottom">
                            <small class="text-muted d-block mb-1">Distance</small>
                            <p class="mb-0">
                                <i class="bx bx-map-alt me-2 text-primary"></i>
                                <strong>{{ number_format($parcel->distance, 2) }} km</strong>
                            </p>
                        </div>

                        <div class="mb-3 pb-3 border-bottom">
                            <small class="text-muted d-block mb-1">Status</small>
                            <span
                                class="badge rounded-pill 
                            {{ $parcel->status === 'delivered' ? 'bg-success' : '' }}
                            {{ $parcel->status === 'in_transit' ? 'bg-info' : '' }}
                            {{ $parcel->status === 'pending' ? 'bg-warning text-dark' : '' }}
                            {{ $parcel->status === 'cancelled' ? 'bg-danger' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                            </span>
                        </div>

                        <div class="mb-3 pb-3 border-bottom">
                            <small class="text-muted d-block mb-1">Created At</small>
                            <p class="mb-0">
                                <i class="bx bx-calendar me-2 text-primary"></i>
                                {{ $parcel->created_at->format('M d, Y') }}
                                <br>
                                <small class="text-muted ms-4">{{ $parcel->created_at->format('h:i A') }}</small>
                            </p>
                        </div>

                        <div>
                            <small class="text-muted d-block mb-1">Last Updated</small>
                            <p class="mb-0">
                                <i class="bx bx-time me-2 text-primary"></i>
                                {{ $parcel->updated_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions Card --}}
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="fw-semibold mb-0">
                            <i class="bx bx-grid-alt me-2 text-primary"></i>Quick Actions
                        </h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="d-grid gap-2">

                            <button class="btn btn-outline-primary ounded-3 text-start" data-bs-toggle="modal"
                                data-bs-target="#assignCourierModal">
                                <i class="bx bx-plus me-1"></i>{{ __('Assign Courier') }}
                            </button>


                            @if ($parcel->status !== 'cancelled')
                                {{-- <form action="{{ route('admin.parcels.destroy', $parcel->id) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this parcel?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger rounded-3 text-start w-100">
                                <i class="bx bx-trash me-2"></i> Delete Parcel
                            </button>
                        </form> --}}
                            @endif
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <div class="modal fade" id="assignCourierModal" tabindex="-1" aria-labelledby="assignCourierModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow" wire:ignore.self>
                    <livewire:parcel.parcel_assignment_form :parcel="$parcel" />
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
        }

        @media print {

            .btn,
            .card-header h5 i {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #dee2e6 !important;
            }
        }
    </style>

    <script>
        function copyTrackingCode(code) {
            navigator.clipboard.writeText(code).then(function() {
                alert('Tracking code copied to clipboard: ' + code);
            }, function() {
                alert('Failed to copy tracking code');
            });
        }
    </script>
</x-layout.app>
