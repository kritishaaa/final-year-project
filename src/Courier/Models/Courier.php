<?php

namespace Src\Courier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'couriers';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'branch_id',
        'vehicle_number',
        'contact_number',
        'active',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Relationships
     */

    // Each courier belongs to one user
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Each courier belongs to one branch (optional)
    public function branch()
    {
        return $this->belongsTo(\Src\Branch\Models\Branch::class);
    }
    public function parcelAssignments()
    {
        return $this->hasMany(\Src\Parcel\Models\ParcelAssignment::class, 'courier_id');
    }
}
