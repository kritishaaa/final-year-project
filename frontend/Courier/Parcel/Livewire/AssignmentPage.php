<?php

namespace Frontend\Courier\Parcel\Livewire;

use App\Traits\SessionFlash;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Src\Parcel\Models\ParcelAssignment;

class AssignmentPage extends Component
{
    use SessionFlash;
    public ?Collection $assignments = null;


    
    public function render(){
        return view("Courier.Parcel::livewire.assignments");
    }

    public function mount(Collection $assignments)
    {
        $this->assignments = $assignments;
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

        $courierName = auth()->user()->name ?? 'Unknown';
        \Src\Parcel\Models\ParcelTrack::create([
                'parcel_id' => $parcel->id,
                'status' => 'assigned',
                'message' => "Your parcel has been assigned to courier {$courierName}.",
               
            ]);

       
        $this->parcels = $this->parcels->map(function ($p) use ($parcelId) {
            if ($p->id == $parcelId) $p->status = 'in_transit';
            return $p;
        });
    }


     public function updateStatus($assignmentId, $status)
    {
        $assignment = ParcelAssignment::find($assignmentId);
    
        if (!$assignment) {
            $this->flashError('Assignment not found!');
            return;
        }
    
        // Update assignment status
        $assignment->status = $status;
        $assignment->update();
    
        // Add tracking message
        $statusMessages = [
            'assigned'   => 'Your parcel has been assigned to a courier.',
            'picked'     => 'Your parcel has been picked up from the sender.',
            'in_transit' => 'Your parcel is on the way to the destination.',
            'delivered'  => 'Your parcel has been delivered successfully.',
            'returned'   => 'Your parcel could not be delivered and is being returned.',
        ];
    
        $message = $statusMessages[$status] ?? 'Status updated.';
    
        // Save tracking
        \Src\Parcel\Models\ParcelTrack::create([
            'parcel_id' => $assignment->parcel_id,
            'status'    => $status,
            'message'   => $message,
            'location'  => $assignment->parcel->destination_address ?? null, // optional
        ]);
    
        $this->assignments = $this->assignments->map(function ($a) use ($assignmentId, $status) {
            if ($a->id == $assignmentId) {
                $a->status = $status;
            }
            return $a;
        });
    
        $this->successFlash("Status updated to " . ucfirst(str_replace('_', ' ', $status)) . "!");
    
        return redirect()->route('courier.parcels.assign');
    }


   

}
