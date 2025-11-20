<form wire:submit.prevent="save">
    <div class="card-body">
        <div class="row">
            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='name' class="mb-2 mt-4">{{ __('Name') }}</label>
                    <input wire:model='user.name' name='name' type='text'
                        class="form-control {{ $errors->has('user.name') ? 'is-invalid' : '' }}"
                        style="{{ $errors->has('user.name') ? 'border: 1px solid #dc3545; box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);' : '' }}"
                        placeholder="{{ __('Enter Name') }}">
                    @error('user.name')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='email' class="mb-2 mt-4">{{ __('Email') }}</label>
                    <input wire:model='user.email' name='email' type='text'
                        class="form-control {{ $errors->has('user.email') ? 'is-invalid' : '' }}"
                        style="{{ $errors->has('user.email') ? 'border: 1px solid #dc3545; box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);' : '' }}"
                        placeholder="{{ __('Enter Email') }}">
                    @error('user.email')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='mobile_no' class="mb-2 mt-4">{{ __('Phone Number') }}</label>
                    <input wire:model='user.mobile_no' name='mobile_no' type='text'
                        class="form-control {{ $errors->has('user.mobile_no') ? 'is-invalid' : '' }}"
                        style="{{ $errors->has('user.mobile_no') ? 'border: 1px solid #dc3545; box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);' : '' }}"
                        placeholder="{{ __('Enter Phone Number') }}">
                    @error('user.mobile_no')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='password' class="mb-2 mt-4">{{ __(' Password') }}</label>
                    <input wire:model='user_password' name='password' type='password'
                        class="form-control {{ $errors->has('user_password') ? 'is-invalid' : '' }}"
                        style="{{ $errors->has('user_password') ? 'border: 1px solid #dc3545; box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);' : '' }}"
                        placeholder="{{ __('Enter Password') }}">
                    @error('user_password')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class='col-md-6 mb-4'>
                <div class='form-group'>
                    <label for='signature' class="mb-2 mt-4">{{ __(' Image') }}</label>
                    <input wire:model='userSignature' name='signature' type='file'
                        class="form-control {{ $errors->has('userSignature') ? 'is-invalid' : '' }}"
                        style="{{ $errors->has('userSignature') ? 'border: 1px solid #dc3545; box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);' : '' }}"
                        placeholder="{{ __(' signature') }}">
                    <div wire:loading wire:target="userSignature">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Uploading...
                    </div>
                    @if ($userSignatureUrl)
                        <div class="col-12 mb-3">
                            <p class="mb-1">
                                <strong>{{ __('Signature Preview') }}:</strong>
                            </p>
                            <a href="{{ $userSignatureUrl }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bx bx-file"></i> {{ __(' View') }}
                            </a>
                        </div>
                    @endif
                    @error('userSignature')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
            </div>


        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary"
            wire:loading.attr="disabled">{{ __(' save') }}</button>
        <a href="javascript:void(0);" class="btn btn-danger" wire:loading.attr="disabled"
            onclick="window.history.back();">{{ __(' back') }} </a>

    </div>
</form>

<script>
    Livewire.on('goBack', () => {
        window.history.back();
    });
</script>
