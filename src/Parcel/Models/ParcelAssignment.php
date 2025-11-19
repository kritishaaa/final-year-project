<?php

namespace Src\Parcel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Branch\Models\Branch;
use Src\Courier\Models\Courier;

class ParcelAssignment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'parcel_assignments';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'parcel_id',
        'courier_id',
        'status',
        'assigned_at',
        'delivered_at',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
          'assigned_at'  => 'datetime',
        'delivered_at' => 'datetime',
        'status'       => 'string',
    ];

    /**
     * Relationships
     */
    
    // From branch
      public function parcel()
    {
        return $this->belongsTo(Parcel::class, 'parcel_id');
    }

    // Assignment belongs to a Courier
    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }

   
}
