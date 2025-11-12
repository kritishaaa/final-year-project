<?php

namespace Src\Parcel\Service;

use Illuminate\Support\Facades\Auth;

use Src\Parcel\DTO\ParcelAdminDto;
use Src\Parcel\Models\Parcel;

class ParcelAdminService
{
    public function store(ParcelAdminDto $parcelAdminDto): array | Parcel
    {
        $parcel = Parcel::create([
            'tracking_code' => $parcelAdminDto->tracking_code,
            'sender_name'=> $parcelAdminDto->sender_name,
            'sender_address'=> $parcelAdminDto->sender_address,
            'sender_contact'=> $parcelAdminDto->sender_contact,
            'from_branch_id'=> $parcelAdminDto->from_branch_id,
            'to_branch_id'=> $parcelAdminDto->to_branch_id,
            'weight'=> $parcelAdminDto->weight,
            'distance'=> $parcelAdminDto->distance,
            'price'=> $parcelAdminDto->price,
            'status'=> $parcelAdminDto->status,
            'recipient_name'=> $parcelAdminDto->recipient_name,
            'recipient_contact'=> $parcelAdminDto->recipient_contact,
            'recipient_address'=> $parcelAdminDto->recipient_address,
            'remarks'=> $parcelAdminDto->remarks,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->id,
        ]);

        return $parcel;
    }

    public function update(Parcel $parcel, ParcelAdminDto $parcelAdminDto)
    {

        return tap($parcel)->update([
            'tracking_code' => $parcelAdminDto->tracking_code,
            'sender_name'=> $parcelAdminDto->sender_name,
            'sender_address'=> $parcelAdminDto->sender_address,
            'sender_contact'=> $parcelAdminDto->sender_contact,
            'from_branch_id'=> $parcelAdminDto->from_branch_id,
            'to_branch_id'=> $parcelAdminDto->to_branch_id,
            'weight'=> $parcelAdminDto->weight,
            'distance'=> $parcelAdminDto->distance,
            'price'=> $parcelAdminDto->price,
            'status'=> $parcelAdminDto->status,
            'recipient_name'=> $parcelAdminDto->recipient_name,
            'recipient_contact'=> $parcelAdminDto->recipient_contact,
            'recipient_address'=> $parcelAdminDto->recipient_address,
            'updated_at' => now(),
            'updated_by' => Auth::user()->id,
        ]);
        
    }

    public function delete(Parcel $parcel)
    {
        return tap($parcel)->update([
            'deleted_at' => now(),
            'deleted_by' => Auth::user()->id,
        ]);
    }

     public function toggleUserStatus(Parcel $parcel): void
    {
        $active = !$parcel->active;
        $parcel->update([
            'active' => $active,
            'updated_at' => now(),
            'updated_by' => Auth::user()->id
        ]);
     
    }

}
