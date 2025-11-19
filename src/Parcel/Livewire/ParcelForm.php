<?php

namespace Src\Parcel\Livewire;

use App\Enums\Action;
use App\Traits\SessionFlash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Src\Parcel\Models\Parcel;
use Src\Parcel\DTO\ParcelAdminDto;
use Src\Parcel\Service\ParcelAdminService;
use Src\Branch\Models\Branch;

class ParcelForm extends Component
{
    use SessionFlash, WithFileUploads;

    public ?Parcel $parcel;
    public ?Action $action;
    public array $branches = [];
    public int $currentStep = 1;

    public $deliveryLatitude;
    public $deliveryLongitude;

    public $branchLat;
    public $branchLng;

    public function rules(): array
    {
        return [
            'parcel.tracking_code' => ['required', 'string', 'max:50'],
            'parcel.sender_name' => ['required', 'string', 'max:255'],
            'parcel.sender_address' => ['required', 'string'],
            'parcel.sender_contact' => ['required', 'string', 'max:20'],
            'parcel.from_branch_id' => ['required', 'exists:branches,id'],
            'parcel.destination_longitude' => ['required'],
            'parcel.destination_latitude' => ['required'],

            'parcel.weight' => ['required', 'numeric', 'min:0.01'],
            'parcel.distance' => ['nullable', 'numeric'],
            'parcel.price' => ['nullable', 'numeric'],
            'parcel.status' => ['nullable', Rule::in(['pending', 'in_transit', 'delivered', 'cancelled'])],
            'parcel.recipient_name' => ['required', 'string'],
            'parcel.recipient_contact' => ['required', 'string'],
            'parcel.recipient_address' => ['required', 'string'],
            'parcel.remarks' => ['nullable', 'string'],
        ];
    }

    public function mount(Parcel $parcel, Action $action)
    {
        $this->action = $action;
        $this->parcel = $parcel;


        // Set default status for new parcels
        if ($this->action === Action::CREATE && !$this->parcel->status) {
            $this->parcel->status = 'pending';
        }

        $this->branches = Branch::select('id', 'name', 'latitude', 'longitude')->get()->toArray();
    }

    // --- Wizard Navigation ---
    public function nextStep()
    {
        // $this->validateCurrentStep();
        if ($this->currentStep + 1 == 4) {
            if ($this->deliveryLatitude === null || $this->deliveryLongitude === null) {
                $this->errorFlash('Please select location on the map');
                return;
            }
        }

        if ($this->currentStep < 4) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
        $this->initializeMap();
    }

    public function initializeMap()
    {

        // if ($this->currentStep + 1 == 4) {
        //     if ($this->deliveryLatitude === null || $this->deliveryLongitude === null) {
        //         $this->errorFlash('Please select location on the map');
        //         return;
        //     }
        // }
    }



    private function validateCurrentStep()
    {
        $validationRules = match ($this->currentStep) {
            1 => [
                'parcel.sender_name' => $this->rules()['parcel.sender_name'],
                'parcel.sender_contact' => $this->rules()['parcel.sender_contact'],
                'parcel.sender_address' => $this->rules()['parcel.sender_address'],
            ],
            2 => [
                'parcel.recipient_name' => $this->rules()['parcel.recipient_name'],
                'parcel.recipient_contact' => $this->rules()['parcel.recipient_contact'],
                'parcel.recipient_address' => $this->rules()['parcel.recipient_address'],
            ],
            3 => [
                'parcel.tracking_code' => $this->rules()['parcel.tracking_code'],
                'parcel.weight' => $this->rules()['parcel.weight'],
                'parcel.from_branch_id' => $this->rules()['parcel.from_branch_id'],
                'parcel.to_branch_id' => $this->rules()['parcel.to_branch_id'],
            ],
            default => [],
        };

        if (!empty($validationRules)) {
            $this->validate($validationRules);
        }
    }




    public function calculateDistance()
    {
        if ($this->deliveryLatitude && $this->deliveryLongitude ) {

           $this->branchLat = $this->parcel->fromBranch->latitude;
   
           $this->branchLng = $this->parcel->fromBranch->longitude;
           // Calculate distance
           $this->parcel->distance = round($this->haversine(
               $this->branchLat,
               $this->branchLng,
               $this->deliveryLatitude,
               $this->deliveryLongitude
            ), 2); // rounded to 2 decimals
            
            // --- Price calculation ---
            $baseRate = 50;      // Base rate in Rs
            $perKm = 10;         // Rs per km
            $perKg = 20;         // Rs per kg
            $weight = $this->parcel->weight ?? 1; // default weight = 1 kg

            $this->parcel->price = round(
                $baseRate + ($this->parcel->distance * $perKm) + ($weight * $perKg),
                2
            );
        }
    }


    private function haversine($lat1, $lon1, $lat2, $lon2)
    {
        $earth = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earth * $c, 2);
    }
    
    public function updated($field)
    {
        if (in_array($field, ['deliveryLatitude', 'deliveryLongitude'])) {
            $this->calculateDistance();
        }
    }
    public function fromBranchChanged()
    {
        $branchId = $this->parcel['from_branch_id'];


        foreach ($this->branches as $branch) {
            if ($branch['id'] == $branchId) {
                $this->branchLat = $branch['latitude'];
                $this->branchLng = $branch['longitude'];
                return;
            }
        }
    }


   public function save()
{
    $this->parcel->destination_latitude = $this->deliveryLatitude;
    $this->parcel->destination_longitude = $this->deliveryLongitude;

    $this->validate();
    $dto = ParcelAdminDto::fromLiveWireModel($this->parcel);
    $service = new ParcelAdminService();

    DB::beginTransaction();
    try {

        match ($this->action) {
            Action::CREATE => $parcel = $service->store($dto),
            Action::UPDATE => $service->update($this->parcel, $dto),
        };

        // Insert tracking log when CREATED
        if ($this->action === Action::CREATE) {

            $start = $parcel->sender_address ?? 'Unknown';
            $end = $parcel->recipient_address ?? 'Unknown';

            \Src\Parcel\Models\ParcelTrack::create([
                'parcel_id' => $parcel->id,
                'status' => 'created',
                'message' => "Your parcel has been created from {$start} to {$end}.",
                'location' => $start,
            ]);
        }

        DB::commit();

        $msg = $this->action === Action::CREATE ? 'Parcel Created Successfully' : 'Parcel Updated Successfully';
        $this->successFlash(__($msg));
        return redirect()->route('admin.parcels.index');

    } catch (\Exception $e) {
        logger($e);
        DB::rollBack();
        $this->addError('parcel', 'An error occurred: ' . $e->getMessage());
    }
}

    public function render()
    {
        return view('Parcel::livewire.form');
    }
}