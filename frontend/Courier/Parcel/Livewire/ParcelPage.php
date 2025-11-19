<?php

namespace Frontend\Courier\Parcel\Livewire;

use App\Traits\SessionFlash;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Src\Courier\Models\Courier;
use Src\Parcel\Models\Parcel;
use Src\Parcel\Models\ParcelAssignment;

class ParcelPage extends Component
{
    use SessionFlash;
    public  $parcels = null;


    
    public function render(){
        return view("Courier.Parcel::livewire.parcels");
    }

    public function mount()
    {
       $this->getParcelData();

    }


    public function getParcelData()
    {
        $userId = auth()->user()->id;
    $courier = Courier::where('user_id', $userId)->first();

    // Get parcels from the courier's branch
    $this->parcels = Parcel::where('from_branch_id', $courier->branch_id)
        // Exclude parcels that are already assigned to this courier
        ->whereDoesntHave('assignments', function($query) use ($courier) {
            $query->where('courier_id', $courier->id);
        })
        ->get();
    }
    public function assignMe($parcelId)
    {
        $parcel = $this->parcels->firstWhere('id', $parcelId);

        if (!$parcel) {
            $this->flashError('Parcel not found!');
            return;
        }

        
        if ($parcel->status === 'assigned') {
            $this->errorFlash('This parcel is already assigned!');
            return;
        }

       
        ParcelAssignment::create([
            'parcel_id' => $parcel->id,
            'courier_id' => auth()->user()->id,
            'status' => 'assigned',
            'assigned_at' => Carbon::now(),
        ]);

        $parcel->status = 'assigned';
        $parcel->save();

        $this->successFlash('Parcel assigned to you successfully!');

       
        $this->parcels = $this->parcels->map(function ($p) use ($parcelId) {
            if ($p->id == $parcelId) $p->status = 'assigned';
            return $p;


        });

         $courierName = auth()->user()->name ?? 'Unknown';
        \Src\Parcel\Models\ParcelTrack::create([
                'parcel_id' => $parcel->id,
                'status' => 'assigned',
                'message' => "Your parcel has been assigned to courier {$courierName}.",
               
            ]);


        $this->getParcelData();
    }


   

}
