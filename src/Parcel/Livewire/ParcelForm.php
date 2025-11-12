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

    public function rules(): array
    {
        return [
            'parcel.tracking_code' => ['required', 'string', 'max:50'],
            'parcel.sender_name' => ['required', 'string', 'max:255'],
            'parcel.sender_address' => ['required', 'string'],
            'parcel.sender_contact' => ['required', 'string', 'max:20'],
            'parcel.from_branch_id' => ['required', 'exists:branches,id'],
            'parcel.to_branch_id' => ['required', 'exists:branches,id'],
            'parcel.weight' => ['required', 'numeric', 'min:0.01'],
            'parcel.distance' => ['nullable', 'numeric'],
            'parcel.price' => ['nullable', 'numeric'],
            'parcel.status' => ['nullable', Rule::in(['pending','in_transit','delivered','cancelled'])],
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
        $this->validateCurrentStep();
        
        if ($this->currentStep < 4) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    private function validateCurrentStep()
    {
        $validationRules = match($this->currentStep) {
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

    public function updatedParcelFromBranchId() 
    { 
        $this->calculateDistanceAndPrice(); 
    }
    
    public function updatedParcelToBranchId() 
    { 
        $this->calculateDistanceAndPrice(); 
    }
    
    public function updatedParcelWeight() 
    { 
        $this->calculateDistanceAndPrice(); 
    }

    public function calculateDistanceAndPrice(): void
    {
        if (!$this->parcel->from_branch_id || 
            !$this->parcel->to_branch_id || 
            !$this->parcel->weight) {
            return;
        }
    
        $from = Branch::find($this->parcel->from_branch_id);
        $to = Branch::find($this->parcel->to_branch_id);
    
        if (!$from || !$to || !$from->latitude || !$to->latitude) {
            $this->addError('parcel', 'Invalid branch data. Please ensure branches have valid coordinates.');
            return;
        }
    
        // --- Haversine formula ---
        $earthRadius = 6371; // km
        $lat1 = deg2rad($from->latitude);
        $lon1 = deg2rad($from->longitude);
        $lat2 = deg2rad($to->latitude);
        $lon2 = deg2rad($to->longitude);
    
        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;
    
        $a = sin($deltaLat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($deltaLon / 2) ** 2;
        $c = 2 * asin(sqrt($a));
        $distance = $earthRadius * $c;
    
        $this->parcel->distance = round($distance, 2);
    
        // --- Price calculation ---
        $baseRate = 50;      // Base rate in Rs
        $perKm = 10;         // Rs per km
        $perKg = 20;         // Rs per kg
        $weight = $this->parcel->weight ?? 1;
    
        $this->parcel->price = round($baseRate + ($distance * $perKm) + ($weight * $perKg), 2);
        
        // Clear any previous errors
        $this->resetErrorBag('parcel');
    }

    public function save()
    {
        $this->validate();

        if (!$this->parcel->distance || !$this->parcel->price) {
            $this->calculateDistanceAndPrice();
            
            if (!$this->parcel->distance || !$this->parcel->price) {
                $this->addError('parcel', 'Unable to calculate distance and price. Please check branch information.');
                return;
            }
        }

        $dto = ParcelAdminDto::fromLiveWireModel($this->parcel);
        $service = new ParcelAdminService();

        DB::beginTransaction();
        try {
            match ($this->action) {
                Action::CREATE => $service->store($dto),
                Action::UPDATE => $service->update($this->parcel, $dto),
            };
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