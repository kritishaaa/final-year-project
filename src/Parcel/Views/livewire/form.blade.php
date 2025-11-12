<div>
    <form wire:submit.prevent="save" class="p-4">
        <div class="card shadow-lg border-0 rounded-4">
            {{-- Header with Progress --}}
            <div class="card-header bg-gradient-primary text-white rounded-top-4 p-4">
                <h4 class="mb-3 fw-semibold">
                    {{ $action === \App\Enums\Action::CREATE ? 'Create New Parcel' : 'Update Parcel' }}
                </h4>

                {{-- Wizard Steps Progress --}}
                <div class="wizard-progress">
                    <div class="d-flex justify-content-between align-items-center position-relative">
                        {{-- Progress Line --}}
                        <div class="wizard-line position-absolute"
                            style="left: 0; right: 0; height: 3px; background: rgba(255,255,255,0.3); top: 50%; transform: translateY(-50%); z-index: 0;">
                        </div>
                        <div class="wizard-line-active position-absolute"
                            style="left: 0; height: 3px; background: white; top: 50%; transform: translateY(-50%); z-index: 0; transition: width 0.3s ease; width: {{ (($currentStep - 1) / 3) * 100 }}%;">
                        </div>

                        @foreach ([
        1 => ['icon' => 'bx-user', 'label' => 'Sender'],
        2 => ['icon' => 'bx-map-pin', 'label' => 'Recipient'],
        3 => ['icon' => 'bx-package', 'label' => 'Parcel Details'],
        4 => ['icon' => 'bx-check-circle', 'label' => 'Review'],
    ] as $step => $data)
                            <div class="wizard-step text-center position-relative" style="z-index: 1;">
                                <div class="step-circle mx-auto mb-2 rounded-circle d-flex align-items-center justify-content-center {{ $currentStep >= $step ? 'active' : '' }}"
                                    style="width: 45px; height: 45px; background: {{ $currentStep >= $step ? 'white' : 'rgba(255,255,255,0.3)' }}; transition: all 0.3s ease;">
                                    <i class="bx {{ $data['icon'] }} fs-5"
                                        style="color: {{ $currentStep >= $step ? '#0d6efd' : 'white' }};"></i>
                                </div>
                                <small class="d-block fw-semibold"
                                    style="font-size: 0.75rem;">{{ $data['label'] }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Body with Steps --}}
            <div class="card-body bg-light p-4" style="min-height: 400px;">

                {{-- Step 1: Sender Information --}}
                @if ($currentStep === 1)
                    <div class="wizard-content animate__animated animate__fadeIn">
                        <h5 class="text-primary fw-semibold mb-4 d-flex align-items-center">
                            <i class="bx bx-user me-2 fs-4"></i> Sender Information
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Sender Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model="parcel.sender_name"
                                    class="form-control form-control-lg rounded-3 @error('parcel.sender_name') is-invalid @enderror"
                                    placeholder="John Doe">
                                @error('parcel.sender_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Sender Contact <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model="parcel.sender_contact"
                                    class="form-control form-control-lg rounded-3 @error('parcel.sender_contact') is-invalid @enderror"
                                    placeholder="+977 98XXXXXXXX">
                                @error('parcel.sender_contact')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Sender Address <span
                                        class="text-danger">*</span></label>
                                <textarea wire:model="parcel.sender_address"
                                    class="form-control form-control-lg rounded-3 @error('parcel.sender_address') is-invalid @enderror" rows="3"
                                    placeholder="Enter complete address with city"></textarea>
                                @error('parcel.sender_address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Step 2: Recipient Information --}}
                @if ($currentStep === 2)
                    <div class="wizard-content animate__animated animate__fadeIn">
                        <h5 class="text-primary fw-semibold mb-4 d-flex align-items-center">
                            <i class="bx bx-map-pin me-2 fs-4"></i> Recipient Information
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Recipient Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model="parcel.recipient_name"
                                    class="form-control form-control-lg rounded-3 @error('parcel.recipient_name') is-invalid @enderror"
                                    placeholder="Jane Smith">
                                @error('parcel.recipient_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Recipient Contact <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model="parcel.recipient_contact"
                                    class="form-control form-control-lg rounded-3 @error('parcel.recipient_contact') is-invalid @enderror"
                                    placeholder="+977 98XXXXXXXX">
                                @error('parcel.recipient_contact')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Recipient Address <span
                                        class="text-danger">*</span></label>
                                <textarea wire:model="parcel.recipient_address"
                                    class="form-control form-control-lg rounded-3 @error('parcel.recipient_address') is-invalid @enderror"
                                    rows="3" placeholder="Enter complete address with city"></textarea>
                                @error('parcel.recipient_address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Step 3: Parcel Details --}}
                @if ($currentStep === 3)
                    <div class="wizard-content animate__animated animate__fadeIn">
                        <h5 class="text-primary fw-semibold mb-4 d-flex align-items-center">
                            <i class="bx bx-package me-2 fs-4"></i> Parcel Details
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tracking Code <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model="parcel.tracking_code"
                                    class="form-control form-control-lg rounded-3 @error('parcel.tracking_code') is-invalid @enderror"
                                    placeholder="TRK123456">
                                @error('parcel.tracking_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Weight (kg) <span
                                        class="text-danger">*</span></label>
                                <input type="number" step="0.01" wire:model.lazy="parcel.weight"
                                    class="form-control form-control-lg rounded-3 @error('parcel.weight') is-invalid @enderror"
                                    placeholder="0.00">
                                @error('parcel.weight')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">From Branch <span
                                        class="text-danger">*</span></label>
                                <select wire:model="parcel.from_branch_id"
                                    class="form-select form-select-lg rounded-3 @error('parcel.from_branch_id') is-invalid @enderror">
                                    <option value="">Select Origin Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('parcel.from_branch_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">To Branch <span
                                        class="text-danger">*</span></label>
                                <select wire:model="parcel.to_branch_id"
                                    class="form-select form-select-lg rounded-3 @error('parcel.to_branch_id') is-invalid @enderror">
                                    <option value="">Select Destination Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('parcel.to_branch_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Auto Calculated Fields
<div class="col-12 mt-3">
    <div wire:loading.flex class="alert alert-info rounded-3 align-items-center" role="alert">
        <i class="bx bx-loader-alt bx-spin me-2 fs-4"></i>
        <div>Calculating distance and price...</div>
    </div>
</div>

@if ($parcel->distance && $parcel->price)
    <div class="col-12 mt-4">
        <div class="alert alert-success rounded-3 d-flex align-items-center" role="alert">
            <i class="bx bx-check-circle fs-3 me-3"></i>
            <div class="flex-grow-1">
                <h6 class="mb-2 fw-semibold">Calculation Complete!</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <small class="text-muted d-block">Distance</small>
                        <strong class="fs-5">{{ number_format($parcel->distance, 2) }} km</strong>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Estimated Price</small>
                        <strong class="fs-5 text-success">Rs. {{ number_format($parcel->price, 2) }}</strong>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Weight</small>
                        <strong class="fs-5">{{ number_format($parcel->weight, 2) }} kg</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif --}}


                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Status</label>
                                <select wire:model="parcel.status"
                                    class="form-select form-select-lg rounded-3 @error('parcel.status') is-invalid @enderror">
                                    <option value="pending">Pending</option>
                                    <option value="in_transit">In Transit</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                @error('parcel.status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Additional Remarks</label>
                                <textarea wire:model="parcel.remarks" rows="3"
                                    class="form-control form-control-lg rounded-3 @error('parcel.remarks') is-invalid @enderror"
                                    placeholder="Any special instructions or notes..."></textarea>
                                @error('parcel.remarks')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Step 4: Review --}}
                @if ($currentStep === 4)
                    <div class="wizard-content animate__animated animate__fadeIn">
                        <h5 class="text-primary fw-semibold mb-4 d-flex align-items-center">
                            <i class="bx bx-check-circle me-2 fs-4"></i> Review Parcel Information
                        </h5>

                        <div class="row g-3">
                            {{-- Sender Card --}}
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-3"><i class="bx bx-user me-2"></i>Sender</h6>
                                        <p class="mb-2"><strong>Name:</strong> {{ $parcel->sender_name }}</p>
                                        <p class="mb-2"><strong>Contact:</strong> {{ $parcel->sender_contact }}</p>
                                        <p class="mb-0"><strong>Address:</strong> {{ $parcel->sender_address }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Recipient Card --}}
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-3"><i class="bx bx-map-pin me-2"></i>Recipient</h6>
                                        <p class="mb-2"><strong>Name:</strong> {{ $parcel->recipient_name }}</p>
                                        <p class="mb-2"><strong>Contact:</strong> {{ $parcel->recipient_contact }}
                                        </p>
                                        <p class="mb-0"><strong>Address:</strong> {{ $parcel->recipient_address }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Parcel Details Card --}}
                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-3"><i class="bx bx-package me-2"></i>Parcel
                                            Information</h6>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p class="mb-2"><strong>Tracking
                                                        Code:</strong><br>{{ $parcel->tracking_code }}</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-2"><strong>Weight:</strong><br>{{ $parcel->weight }} kg
                                                </p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-2">
                                                    <strong>Distance:</strong><br>{{ $parcel->distance ?? 'N/A' }} km
                                                </p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-2"><strong>Price:</strong><br><span
                                                        class="text-success fs-5 fw-bold">Rs.
                                                        {{ $parcel->price ?? 'N/A' }}</span></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-2">
                                                    <strong>From:</strong><br>{{ collect($branches)->firstWhere('id', $parcel->from_branch_id)['name'] ?? 'N/A' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-2">
                                                    <strong>To:</strong><br>{{ collect($branches)->firstWhere('id', $parcel->to_branch_id)['name'] ?? 'N/A' }}
                                                </p>
                                            </div>
                                            @if ($parcel->remarks)
                                                <div class="col-12 mt-2">
                                                    <p class="mb-0">
                                                        <strong>Remarks:</strong><br>{{ $parcel->remarks }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            {{-- Footer with Navigation --}}
            <div class="card-footer bg-white border-0 rounded-bottom-4 p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if ($currentStep > 1)
                            <button type="button" wire:click="previousStep"
                                class="btn btn-outline-secondary rounded-3 px-4">
                                <i class="bx bx-chevron-left me-1"></i> Previous
                            </button>
                        @else
                            <button type="button" onclick="window.history.back();"
                                class="btn btn-outline-secondary rounded-3 px-4">
                                <i class="bx bx-arrow-back me-1"></i> Cancel
                            </button>
                        @endif
                    </div>

                    <div class="text-muted small">
                        Step {{ $currentStep }} of 4
                    </div>

                    <div>
                        @if ($currentStep < 4)
                            <button type="button" wire:click="nextStep" class="btn btn-primary rounded-3 px-4">
                                Next <i class="bx bx-chevron-right ms-1"></i>
                            </button>
                        @else
                            <button type="submit" class="btn btn-success rounded-3 px-4"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="save">
                                    <i class="bx bx-check-circle me-1"></i>
                                    {{ $action === \App\Enums\Action::CREATE ? 'Create Parcel' : 'Update Parcel' }}
                                </span>
                                <span wire:loading wire:target="save">
                                    <span class="spinner-border spinner-border-sm me-2"></span> Saving...
                                </span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .wizard-step small {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .form-control-lg,
        .form-select-lg {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .form-label {
            color: #495057;
            margin-bottom: 0.5rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate__animated.animate__fadeIn {
            animation: fadeIn 0.4s ease-in-out;
        }
    </style>
</div>
