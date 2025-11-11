<form wire:submit.prevent="save">
    <div class="card-body">
        <div class="row">

            {{-- Tracking Code --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tracking_code">{{ __('Tracking Code') }}</label>
                    <input type="text" wire:model="parcel.tracking_code" class="form-control @error('parcel.tracking_code') is-invalid @enderror" placeholder="Enter tracking code">
                    @error('parcel.tracking_code')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Sender Name --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sender_name">{{ __('Sender Name') }}</label>
                    <input type="text" wire:model="parcel.sender_name" class="form-control @error('parcel.sender_name') is-invalid @enderror" placeholder="Enter sender name">
                    @error('parcel.sender_name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Sender Address --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sender_address">{{ __('Sender Address') }}</label>
                    <textarea wire:model="parcel.sender_address" class="form-control @error('parcel.sender_address') is-invalid @enderror" placeholder="Enter sender address"></textarea>
                    @error('parcel.sender_address')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Sender Contact --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sender_contact">{{ __('Sender Contact') }}</label>
                    <input type="text" wire:model="parcel.sender_contact" class="form-control @error('parcel.sender_contact') is-invalid @enderror" placeholder="Enter sender contact">
                    @error('parcel.sender_contact')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- From Branch --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('From Branch') }}</label>
                    <select wire:model="parcel.from_branch_id" class="form-control @error('parcel.from_branch_id') is-invalid @enderror">
                        <option value="">{{ __('Select Branch') }}</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                        @endforeach
                    </select>
                    @error('parcel.from_branch_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- To Branch --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('To Branch') }}</label>
                    <select wire:model="parcel.to_branch_id" class="form-control @error('parcel.to_branch_id') is-invalid @enderror">
                        <option value="">{{ __('Select Branch') }}</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                        @endforeach
                    </select>
                    @error('parcel.to_branch_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Weight --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('Weight (kg)') }}</label>
                    <input type="number" step="0.01" wire:model="parcel.weight" class="form-control @error('parcel.weight') is-invalid @enderror">
                    @error('parcel.weight')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Distance --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('Distance (km)') }}</label>
                    <input type="number" step="0.01" wire:model="parcel.distance" class="form-control @error('parcel.distance') is-invalid @enderror">
                    @error('parcel.distance')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Price --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('Price') }}</label>
                    <input type="number" step="0.01" wire:model="parcel.price" class="form-control @error('parcel.price') is-invalid @enderror">
                    @error('parcel.price')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('Status') }}</label>
                    <select wire:model="parcel.status" class="form-control @error('parcel.status') is-invalid @enderror">
                        <option value="pending">{{ __('Pending') }}</option>
                        <option value="in_transit">{{ __('In Transit') }}</option>
                        <option value="delivered">{{ __('Delivered') }}</option>
                        <option value="cancelled">{{ __('Cancelled') }}</option>
                    </select>
                    @error('parcel.status')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Recipient Name --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('Recipient Name') }}</label>
                    <input type="text" wire:model="parcel.recipient_name" class="form-control @error('parcel.recipient_name') is-invalid @enderror">
                    @error('parcel.recipient_name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Recipient Contact --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('Recipient Contact') }}</label>
                    <input type="text" wire:model="parcel.recipient_contact" class="form-control @error('parcel.recipient_contact') is-invalid @enderror">
                    @error('parcel.recipient_contact')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Recipient Address --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('Recipient Address') }}</label>
                    <textarea wire:model="parcel.recipient_address" class="form-control @error('parcel.recipient_address') is-invalid @enderror"></textarea>
                    @error('parcel.recipient_address')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Remarks --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('Remarks') }}</label>
                    <textarea wire:model="parcel.remarks" class="form-control @error('parcel.remarks') is-invalid @enderror"></textarea>
                    @error('parcel.remarks')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>

        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
            {{ $action === \App\Enums\Action::CREATE ? __('Create') : __('Update') }}
        </button>

        <a href="javascript:void(0);" class="btn btn-danger" wire:loading.attr="disabled"
           onclick="window.history.back();">{{ __('Back') }}</a>
    </div>
</form>

<script>
    Livewire.on('goBack', () => {
        window.history.back();
    });
</script>
