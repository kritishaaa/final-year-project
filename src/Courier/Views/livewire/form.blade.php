<form wire:submit.prevent="save">
    <div class="card-body">
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_id" class="mb-2 mt-4">{{ __('User') }}</label>
                    <select wire:model="courier.user_id" name="user_id"
                        class="form-control {{ $errors->has('courier.user_id') ? 'is-invalid' : '' }}">
                        <option value="">{{ __('Select User') }}</option>
                        @foreach (\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('courier.user_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Select Branch --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="branch_id" class="mb-2 mt-4">{{ __('Branch') }}</label>
                    <select wire:model="courier.branch_id" name="branch_id"
                        class="form-control {{ $errors->has('courier.branch_id') ? 'is-invalid' : '' }}">
                        <option value="">{{ __('Select Branch') }}</option>
                        @foreach (\Src\Branch\Models\Branch::all() as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                    @error('courier.branch_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Vehicle Number --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_number" class="mb-2 mt-4">{{ __('Vehicle Number') }}</label>
                    <input wire:model="courier.vehicle_number" name="vehicle_number" type="text"
                        class="form-control {{ $errors->has('courier.vehicle_number') ? 'is-invalid' : '' }}"
                        placeholder="{{ __('Enter vehicle number') }}">
                    @error('courier.vehicle_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Contact Number --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contact_number" class="mb-2 mt-4">{{ __('Contact Number') }}</label>
                    <input wire:model="courier.contact_number" name="contact_number" type="text"
                        class="form-control {{ $errors->has('courier.contact_number') ? 'is-invalid' : '' }}"
                        placeholder="{{ __('Enter contact number') }}">
                    @error('courier.contact_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Active Checkbox --}}
           <div class="col-md-6 mt-4">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" wire:model="courier.active" id="active">
        <label class="form-check-label" for="active">{{ __('Active') }}</label>
    </div>
</div>


        </div>
    </div>

    {{-- Footer --}}
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
