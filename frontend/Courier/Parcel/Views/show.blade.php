<x-layout.courier-app header="Parcel List">
    <div class="container-fluid p-4">
        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1 fw-bold text-dark">Parcel Details</h3>
                <p class="text-muted mb-0">Complete information about this parcel</p>
            </div>
            <div class="d-flex gap-2">
                {{-- <a href="{{ route('admin.parcels.edit', $parcel->id) }}" class="btn btn-primary rounded-3">
                    <i class="bx bx-edit-alt me-1"></i> Edit Parcel
                </a> --}}
                <a onclick="history.back()" class="btn btn-outline-secondary rounded-3">
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
                                {{ $parcel->status === 'assigned' ? 'bg-info' : '' }}
                                {{ $parcel->status === 'in_transit' ? 'bg-info' : '' }}
                                {{ $parcel->status === 'pending' ? 'bg-warning text-dark' : '' }}
                                {{ $parcel->status === 'cancelled' ? 'bg-danger' : '' }}">
                                    <i
                                        class="bx 
                                    {{ $parcel->status === 'delivered' ? 'bx-check-circle' : '' }}
                                    {{ $parcel->status === 'assigned' ? 'bx-loader-circle' : '' }}
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

                {{-- Add this card after the Quick Actions Card in the Right Column --}}

                {{-- Parcel Tracking Timeline Card --}}
                <div class="card shadow-sm border-0 rounded-4 mt-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="fw-semibold mb-0">
                            <i class="bx bx-time-five me-2 text-primary"></i>Tracking History
                        </h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        @if (isset($parcelTracks) && count($parcelTracks) > 0)
                            <div class="timeline">
                                @foreach ($parcelTracks as $index => $track)
                                    <div class="timeline-item {{ $index === 0 ? 'active' : '' }}">
                                        <div
                                            class="timeline-marker 
                            {{ $track->status === 'delivered' ? 'bg-success' : '' }}
                            {{ $track->status === 'assigned' ? 'bg-info' : '' }}
                            {{ $track->status === 'picked' ? 'bg-info' : '' }}
                            {{ $track->status === 'in_transit' ? 'bg-warning' : '' }}
                            {{ $track->status === 'created' ? 'bg-primary' : '' }}
                            {{ $track->status === 'cancelled' ? 'bg-danger' : '' }}">
                                            <i
                                                class="bx 
                                {{ $track->status === 'delivered' ? 'bx-check-circle' : '' }}
                                {{ $track->status === 'assigned' ? 'bx-user-check' : '' }}
                                {{ $track->status === 'picked' ? 'bx-package' : '' }}
                                {{ $track->status === 'in_transit' ? 'bx-cycling' : '' }}
                                {{ $track->status === 'created' ? 'bx-package' : '' }}
                                {{ $track->status === 'cancelled' ? 'bx-x-circle' : '' }}"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <span
                                                    class="badge rounded-pill 
                                    {{ $track->status === 'delivered' ? 'bg-success' : '' }}
                                    {{ $track->status === 'assigned' ? 'bg-info' : '' }}
                                    {{ $track->status === 'picked' ? 'bg-info' : '' }}
                                    {{ $track->status === 'in_transit' ? 'bg-warning text-dark' : '' }}
                                    {{ $track->status === 'created' ? 'bg-primary' : '' }}
                                    {{ $track->status === 'cancelled' ? 'bg-danger' : '' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $track->status)) }}
                                                </span>
                                                <small
                                                    class="text-muted">{{ $track->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1 text-dark">{{ $track->message }}</p>
                                            @if ($track->location)
                                                <small class="text-muted">
                                                    <i class="bx bx-map-pin me-1"></i>{{ $track->location }}
                                                </small>
                                            @endif
                                            <div class="text-muted small mt-1">
                                                {{ $track->created_at->format('M d, Y - h:i A') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bx bx-package fs-1 text-muted mb-2"></i>
                                <p class="text-muted mb-0">No tracking history available</p>
                            </div>
                        @endif
                    </div>
                </div>

                <style>
                    /* Timeline Styles */
                    .timeline {
                        position: relative;
                        padding-left: 0;
                    }

                    .timeline-item {
                        position: relative;
                        padding-left: 50px;
                        padding-bottom: 30px;
                    }

                    .timeline-item:last-child {
                        padding-bottom: 0;
                    }

                    .timeline-item::before {
                        content: '';
                        position: absolute;
                        left: 17px;
                        top: 40px;
                        bottom: -10px;
                        width: 2px;
                        background: #e5e7eb;
                    }

                    .timeline-item:last-child::before {
                        display: none;
                    }

                    .timeline-marker {
                        position: absolute;
                        left: 0;
                        top: 0;
                        width: 36px;
                        height: 36px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-size: 16px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
                        z-index: 1;
                    }

                    .timeline-item.active .timeline-marker {
                        width: 40px;
                        height: 40px;
                        left: -2px;
                        animation: pulse 2s infinite;
                    }

                    .timeline-content {
                        background: #f8fafc;
                        padding: 12px 16px;
                        border-radius: 10px;
                        border-left: 3px solid #e5e7eb;
                        transition: all 0.3s ease;
                    }

                    .timeline-item.active .timeline-content {
                        background: #fff;
                        border-left-color: #3b82f6;
                        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
                    }

                    .timeline-content:hover {
                        background: #fff;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                    }

                    @keyframes pulse {

                        0%,
                        100% {
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
                        }

                        50% {
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15), 0 0 0 8px rgba(59, 130, 246, 0.2);
                        }
                    }

                    /* Responsive adjustments */
                    @media (max-width: 768px) {
                        .timeline-item {
                            padding-left: 45px;
                        }

                        .timeline-marker {
                            width: 32px;
                            height: 32px;
                            font-size: 14px;
                        }

                        .timeline-item.active .timeline-marker {
                            width: 36px;
                            height: 36px;
                        }
                    }
                </style>

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
                            <small class="text-muted d-block mb-1">Created Date</small>
                            <p class="mb-0">
                                <i class="bx bx-calendar me-2 text-primary"></i>
                                {{ $parcel->created_at->format('M d, Y') }}
                                <br>
                                <small class="text-muted ms-4">{{ $parcel->created_at->format('h:i A') }}</small>
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
                        {{--  --}}

                        {{-- Courier Table --}}
                        @if (isset($assignedCouriers) && count($assignedCouriers) > 0)
                            <div class="mt-4">
                                <h6 class="fw-bold mb-2">Assigned Couriers</h6>

                                <div class="table-responsive small">
                                    <table class="table table-sm table-striped align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Courier Name</th>
                                                <th>Assigned At</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($assignedCouriers as $index => $courier)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $courier->courier->user?->name }}</td>
                                                    <td>{{ $courier->created_at->format('d M, Y') }}</td>
                                                    <td>{{ $courier->status }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @else
                            <p class="text-muted mt-3 small">No couriers assigned yet.</p>
                        @endif
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
</x-layout.courier-app>
