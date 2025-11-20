<?php

namespace Frontend\Courier\Parcel\Livewire;

use App\Traits\SessionFlash;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Src\Courier\Models\Courier;
use Src\Parcel\Models\ParcelAssignment;

class AssignmentPage extends Component
{
    use SessionFlash;
    public ?Collection $assignments = null;
    public $optimizedAssignments = []; // will hold parcels in optimized order
    public $totalDistance = 0;
    public $totalPrice = 0;
    public $courier;

    
    public function render(){
        return view("Courier.Parcel::livewire.assignments");
    }

    public function mount(Collection $assignments)
    {
        $this->assignments = $assignments;
        $this->courier = Courier::where('user_id', auth()->user()->id)->with('branch')->first();

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



    public function optimizeRoute()
    {
        $courierId = auth()->user()->id;
        $courier = Courier::where('user_id', $courierId)->with('branch')->first();

        $branchLat = $courier->branch->latitude;
        $branchLng = $courier->branch->longitude;

        // Only assigned parcels for this courier
        $parcels = $this->assignments->toArray();

        $route = [];
        $currentLat = $branchLat;
        $currentLng = $branchLng;

        $remaining = $parcels;
        $totalDistance = 0;
        $totalPrice = 0;

        while (!empty($remaining)) {
            $closestIndex = null;
            $closestDistance = PHP_FLOAT_MAX;

            foreach ($remaining as $index => $parcel) {
                $dist = $this->haversine(
                    $currentLat,
                    $currentLng,
                    $parcel['parcel']['destination_latitude'],
                    $parcel['parcel']['destination_longitude']
                );

                if ($dist < $closestDistance) {
                    $closestDistance = $dist;
                    $closestIndex = $index;
                }
            }

            $totalDistance += $closestDistance;
            $totalPrice += $remaining[$closestIndex]['parcel']['price'];

            $route[] = $remaining[$closestIndex];

            $currentLat = $remaining[$closestIndex]['parcel']['destination_latitude'];
            $currentLng = $remaining[$closestIndex]['parcel']['destination_longitude'];

            unset($remaining[$closestIndex]);
            $remaining = array_values($remaining);
        }

        $this->optimizedAssignments = $route;
        $this->totalDistance = $totalDistance;
        $this->totalPrice = $totalPrice;
    }

    // Haversine function
    private function haversine($lat1, $lon1, $lat2, $lon2)
    {
        $earth = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) ** 2 +
            cos(deg2rad($lat1)) *
            cos(deg2rad($lat2)) *
            sin($dLon / 2) ** 2;

        return 2 * $earth * asin(sqrt($a));
    }

   

}
