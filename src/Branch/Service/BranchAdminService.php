<?php

namespace Src\Branch\Service;

use Illuminate\Support\Facades\Auth;
use Src\Branch\DTO\BranchAdminDto;
use Src\Branch\Models\Branch;

class BranchAdminService
{
    public function store(BranchAdminDto $branchAdminDto): array | Branch
    {
        $branch = Branch::create([
            'name' => $branchAdminDto->name,
            'address' => $branchAdminDto->address,
            'code' => $branchAdminDto->code,
            'latitude' => $branchAdminDto->latitude,
            'longitude' => $branchAdminDto->longitude,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->id,
        ]);

        return $branch;
    }

    public function update(Branch $branch, BranchAdminDto $branchAdminDto): bool
    {

        $updateData = [
            'name' => $branchAdminDto->name,
            'address' => $branchAdminDto->address,
            'code' => $branchAdminDto->code,
            'latitude' => $branchAdminDto->latitude,
            'longitude' => $branchAdminDto->longitude,
            'updated_at' => now(),
            'updated_by' => Auth::user()->id,
        ];

        
        return $updateData->save();
    }

    public function delete(Branch $branch)
    {
        return tap($branch)->update([
            'deleted_at' => now(),
            'deleted_by' => Auth::user()->id,
        ]);
    }

}
