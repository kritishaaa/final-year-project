<?php

namespace Src\Courier\Service;

use Illuminate\Support\Facades\Auth;
use Src\Courier\DTO\courierAdminDto;
use Src\Courier\Models\Courier;

class CourierAdminService
{
    public function store(CourierAdminDto $courierAdminDto): array | Courier
    {
        $courier = Courier::create([
            'user_id' => $courierAdminDto->user_id,
            'branch_id' => $courierAdminDto->branch_id,
            'vehicle_number'=> $courierAdminDto->vehicle_number,
            'contact_number' => $courierAdminDto->contact_number,
            'active' => $courierAdminDto->active,            
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->id,
        ]);

        return $courier;
    }

    public function update(Courier $courier, CourierAdminDto $courierAdminDto): bool
    {

        $updateData = [
            'user_id' => $courierAdminDto->user_id,
            'branch_id' => $courierAdminDto->branch_id,
            'vehicle_number'=> $courierAdminDto->vehicle_number,
            'contact_number' => $courierAdminDto->contact_number,
            'active' => $courierAdminDto->active,
            'updated_at' => now(),
            'updated_by' => Auth::user()->id,
        ];

        
        return $updateData->save();
    }

    public function delete(Courier $courier)
    {
        return tap($courier)->update([
            'deleted_at' => now(),
            'deleted_by' => Auth::user()->id,
        ]);
    }

     public function toggleUserStatus(Courier $courier): void
    {
        $active = !$courier->active;
        $courier->update([
            'active' => $active,
            'updated_at' => now(),
            'updated_by' => Auth::user()->id
        ]);
     
    }

}
