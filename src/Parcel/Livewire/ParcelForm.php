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

    public function rules(): array
    {
        return [
            'parcel.tracking_code' => ['required', 'string', 'max:50'],
            'parcel.sender_name' => ['required', 'string', 'max:255'],
            'parcel.sender_address' => ['required', 'string'],
            'parcel.sender_contact' => ['required', 'string', 'max:20'],
            'parcel.from_branch_id' => ['required', 'exists:branches,id'],
            'parcel.to_branch_id' => ['required', 'exists:branches,id'],
            'parcel.weight' => ['required', 'numeric'],
            'parcel.distance' => ['nullable', 'numeric'],
            'parcel.price' => ['nullable', 'numeric'],
            'parcel.status' => ['required', Rule::in(['pending','in_transit','delivered','cancelled'])],
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
        $this->branches = Branch::select('id','name')->get()->toArray();
    }

    public function render()
    {
        return view('Parcel::livewire.form');
    }

    public function save()
    {
        $this->validate();

        $dto = new ParcelAdminDto();

        $service = new ParcelAdminService();
        DB::beginTransaction();
        try {
            switch ($this->action) {
                case Action::CREATE:
                    $service->store($dto);
                    DB::commit();
                    $this->successFlash(__('Parcel Created Successfully'));
                    return redirect()->route('admin.parcels.index');

                case Action::UPDATE:
                    $service->update($this->parcel, $dto);
                    DB::commit();
                    $this->successFlash(__('Parcel Updated Successfully'));
                    return redirect()->route('admin.parcels.index');

                default:
                    return $this->redirect(url()->previous());
            }
        } catch (\Exception $e) {
            logger($e);
            DB::rollBack();
            $this->addError('parcel', $e->getMessage());
        }
    }
}
