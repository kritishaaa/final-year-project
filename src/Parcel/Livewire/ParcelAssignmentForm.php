<?php

namespace Src\Parcel\Livewire;

use App\Enums\Action;
use App\Traits\SessionFlash;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Src\Courier\Models\Courier;
use Src\Parcel\Models\Parcel;
use Src\Parcel\DTO\ParcelAdminDto;
use Src\Parcel\Models\ParcelAssignment;
use Src\Parcel\Service\ParcelAdminService;
use Src\Branch\Models\Branch;

class ParcelAssignmentForm extends Component
{
    use SessionFlash, WithFileUploads;

    public ?Parcel $parcel;
    public array $couriers = [];
     public $selectedCourierId;

    protected $rules = [
        'selectedCourierId' => 'required|exists:couriers,id',
        
    ];

    public function mount(Parcel $parcel)
    {
        
        $this->parcel = $parcel;
        $this->couriers = Courier::with('user')->get()->toArray();
        
        
    }

        public function save()
    {
        $this->validate();

        ParcelAssignment::create([
            'parcel_id' => $this->parcel->id,
            'courier_id' => $this->selectedCourierId,
            'status' => 'assigned',
            'assigned_at' => Carbon::now(),
        ]);

        $this->parcel->status = 'in_transit';
        $dto = ParcelAdminDto::fromLiveWireModel($this->parcel);
        $service = new ParcelAdminService();
        $service->update( $this->parcel, $dto);  
        
        
    }

    public function render()
    {
        return view('Parcel::livewire.parcel-assignment-form');
    }
}