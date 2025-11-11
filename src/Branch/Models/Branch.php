<?php

namespace Src\Branch\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'branches';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'code',
        'address',
        'latitude',
        'longitude',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
    ];

    /**
     * Relationships
     * ----------------------------
     * Define how this model connects with others.
     */

    // A branch has many couriers
    // public function couriers()
    // {
    //     return $this->hasMany(Courier::class, 'branch_id');
    // }

    // // A branch can be the "from" location for many parcels
    // public function fromParcels()
    // {
    //     return $this->hasMany(Parcel::class, 'from_branch_id');
    // }

    // // A branch can be the "to" location for many parcels
    // public function toParcels()
    // {
    //     return $this->hasMany(Parcel::class, 'to_branch_id');
    // }
}
