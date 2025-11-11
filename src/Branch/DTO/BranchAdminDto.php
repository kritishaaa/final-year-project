<?php

namespace Src\Branch\DTO;

use Src\Branch\Models\Branch;



class BranchAdminDto
{
    public function __construct(
        public string $name,
        public string $address,
        public string $code,
        public string $latitude,
        public string $longitude,
    ) {}

    public static function fromLiveWireModel(Branch $branch): BranchAdminDto
    {
        return new self(
            name: $branch->name ?? '',
            address: $branch->address ?? '',
            code: $branch->code ?? '',
            longitude: $branch->longitude ?? '',
            latitude: $branch->latitude ?? '',
           
        );
    }

    public static function fromEmployeeLivewireModel(Branch $branch)
    {
        return new self(
            name: $branch->name ?? '',
            address: $branch->address ?? '',
            code: $branch->code ?? '',
            longitude: $branch->longitude ?? '',
            latitude: $branch->latitude ?? '',  

            
        );
    }
}
