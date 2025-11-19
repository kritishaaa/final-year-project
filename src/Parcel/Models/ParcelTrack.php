<?php

namespace Src\Parcel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelTrack extends Model
{
    use HasFactory;

    protected $table = 'parcel_tracks';

    protected $fillable = [
        'parcel_id',
        'status',
        'message',
        'location',
    ];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
}
