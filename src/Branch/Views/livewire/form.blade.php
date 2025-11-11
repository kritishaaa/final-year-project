<form wire:submit.prevent="save">
    <div class="card-body">
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="mb-2 mt-4">{{ __('Name') }}</label>
                    <input wire:model="branch.name" name="name" type="text"
                        class="form-control {{ $errors->has('branch.name') ? 'is-invalid' : '' }}"
                        placeholder="{{ __('Enter branch name') }}">
                    @error('branch.name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="code" class="mb-2 mt-4">{{ __('Code') }}</label>
                    <input wire:model="branch.code" name="code" type="text"
                        class="form-control {{ $errors->has('branch.code') ? 'is-invalid' : '' }}"
                        placeholder="{{ __('Enter branch code') }}">
                    @error('branch.code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="address" class="mb-2 mt-4">{{ __('Address') }}</label>
                    <textarea wire:model="branch.address" name="address"
                        class="form-control {{ $errors->has('branch.address') ? 'is-invalid' : '' }}"
                        placeholder="{{ __('Enter branch address') }}"></textarea>
                    @error('branch.address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="latitude" class="mb-2 mt-4">{{ __('Latitude') }}</label>
                    <input wire:model="branch.latitude" name="latitude" type="text"
                        class="form-control {{ $errors->has('branch.latitude') ? 'is-invalid' : '' }}"
                        placeholder="{{ __('Enter latitude') }}">
                    @error('branch.latitude')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label for="longitude" class="mb-2 mt-4">{{ __('Longitude') }}</label>
                    <input wire:model="branch.longitude" name="longitude" type="text"
                        class="form-control {{ $errors->has('branch.longitude') ? 'is-invalid' : '' }}"
                        placeholder="{{ __('Enter longitude') }}">
                    @error('branch.longitude')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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
