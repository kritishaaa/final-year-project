<?php

namespace Src\Parcel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Branch\Models\Branch;

class Parcel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'parcels';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'tracking_code',
        'sender_name',
        'sender_address',
        'sender_contact',
        'from_branch_id',
        'to_branch_id',
        'weight',
        'distance',
        'price',
        'status',
        'recipient_name',
        'recipient_contact',
        'recipient_address',
        'remarks',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'weight' => 'decimal:2',
        'distance' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    /**
     * Relationships
     */
    
    // From branch
    public function fromBranch()
    {
        return $this->belongsTo(Branch::class, 'from_branch_id');
    }

    // To branch
    public function toBranch()
    {
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }
}
