<div class="modal-content border-0 rounded">
    <div class="modal-header bg-white border-bottom">
        <h5 class="modal-title fw-semibold" id="documentEditModalLabel">
            <i class="bx bx-edit me-2"></i>{{ __('Parcel Assignment') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body p-3">
        <div class="mb-3">
            <label for="courier_id" class="form-label fw-medium text-muted">
                {{ __('Choose Courier') }}
            </label>
            <select wire:model="selectedCourierId" name="courier_id"
                class="form-control {{ $errors->has('selectedCourierId') ? 'is-invalid' : '' }}">
                <option value="">{{ __('Select Courier') }}</option>
                @foreach ($couriers as $courier)
                    <option value="{{ $courier['id'] }}">
                        {{ $courier['user']['name'] ?? 'N/A' }}
                        ({{ $courier['vehicle_number'] }})
                    </option>
                @endforeach
            </select>
            @error('selectedCourierId')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


        <div class="mb-3">

        </div>

        <div class="d-flex justify-content-end bg-white border-top">

            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-primary" wire:click="save" wire:loading.attr="disabled">
                    <i class="fas fa-upload me-2"></i>{{ __('ebps::ebps.upload') }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('document-uploaded', event => {
            const detail = Array.isArray(event.detail) ? event.detail[0] : event.detail;
            const modalId = detail?.modalId;
            if (!modalId) return;

            const modalElement = document.getElementById(modalId);
            if (modalElement) {
                const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
                modal.hide();

                setTimeout(() => {
                    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                    document.body.classList.remove('modal-open');
                }, 300);

                const fileInput = modalElement.querySelector('input[type="file"][wire\\:model="files"]');
                if (fileInput) fileInput.value = null;
            }
        });
    </script>
@endpush
