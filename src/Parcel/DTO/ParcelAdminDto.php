<?php

namespace Src\Parcel\DTO;

use Src\Parcel\Models\Parcel;

class ParcelAdminDto
{
    public function __construct(
        public ?string $tracking_code = null,
        public ?string $sender_name = null,
        public ?string $sender_address = null,
        public ?string $sender_contact = null,
        public ?int $from_branch_id = null,
        public ?string $destination_latitude = null,
        public ?string $destination_longitude = null,
        public ?float $weight = null,
        public ?float $distance = null,
        public ?float $price = null,
        public ?string $status = 'pending',
        public ?string $recipient_name = null,
        public ?string $recipient_contact = null,
        public ?string $recipient_address = null,
        public ?string $remarks = null,
    ) {}

    /**
     * Create a DTO from a Parcel model (Livewire or otherwise)
     */
    public static function fromLiveWireModel(Parcel $parcel): self
    {
        return new self(
            tracking_code: $parcel->tracking_code,
            sender_name: $parcel->sender_name,
            sender_address: $parcel->sender_address,
            sender_contact: $parcel->sender_contact,
            from_branch_id: $parcel->from_branch_id,
            destination_longitude: $parcel->destination_longitude,
            destination_latitude: $parcel->destination_latitude,
            weight: $parcel->weight,
            distance: $parcel->distance,
            price: $parcel->price,
            status: $parcel->status ?? 'pending',
            recipient_name: $parcel->recipient_name,
            recipient_contact: $parcel->recipient_contact,
            recipient_address: $parcel->recipient_address,
            remarks: $parcel->remarks,
        );
    }

    /**
     * Convert DTO back to array (useful for service layer or model creation)
     */
    public function toArray(): array
    {
        return [
            'tracking_code' => $this->tracking_code,
            'sender_name' => $this->sender_name,
            'sender_address' => $this->sender_address,
            'sender_contact' => $this->sender_contact,
            'from_branch_id' => $this->from_branch_id,
            'destination_latitude' => $this->destination_latitude,
            'destination_longitude' => $this->destination_longitude,
            'weight' => $this->weight,
            'distance' => $this->distance,
            'price' => $this->price,
            'status' => $this->status,
            'recipient_name' => $this->recipient_name,
            'recipient_contact' => $this->recipient_contact,
            'recipient_address' => $this->recipient_address,
            'remarks' => $this->remarks,
        ];
    }
}
