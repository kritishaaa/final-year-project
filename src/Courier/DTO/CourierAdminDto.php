<?php

namespace Src\Courier\DTO;

use Src\Courier\Models\Courier;

class CourierAdminDto
{
    public function __construct(
        public ?int $user_id,
        public ?int $branch_id,
        public ?string $vehicle_number,
        public ?string $contact_number,
        public bool $active = true,
    ) {}

    /**
     * Create a DTO instance from a Livewire model.
     */
    public static function fromLiveWireModel(Courier $courier): CourierAdminDto
    {
        return new self(
            user_id: $courier->user_id ?? null,
            branch_id: $courier->branch_id ?? null,
            vehicle_number: $courier->vehicle_number ?? '',
            contact_number: $courier->contact_number ?? '',
            active: $courier->active ?? true,
        );
    }

    /**
     * Create a DTO instance from a Livewire model for employee context (if needed).
     */
    public static function fromEmployeeLivewireModel(Courier $courier): CourierAdminDto
    {
        return new self(
            user_id: $courier->user_id ?? null,
            branch_id: $courier->branch_id ?? null,
            vehicle_number: $courier->vehicle_number ?? '',
            contact_number: $courier->contact_number ?? '',
            active: $courier->active ?? true,
        );
    }
}
