<?php

namespace Src\Courier\Livewire;

use App\Enums\Action;
use App\Traits\SessionFlash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\DB;
use Src\Courier\DTO\CourierAdminDto;
use Src\Courier\Models\Courier;
use Src\Courier\Service\CourierAdminService;

class CourierForm extends Component
{
    use SessionFlash, WithFileUploads;

    public ?Courier $courier;
    public ?Action $action;

    public array $users = [];
    public array $branches = [];

    public function rules(): array
    {
        $rules = [
            'courier.user_id' => ['required'],
            'courier.branch_id' => ['required'],
            'courier.vehicle_number' => ['required', 'string', 'max:20'],
            'courier.contact_number' => ['required', 'string', 'max:15'],
            'courier.active' => ['boolean']

        ];

       
        return $rules;
    }

   

    public function render()
    {
        return view("Courier::livewire.form");
    }

    public function mount(Courier $courier, Action $action)
    {
        $this->action = $action;
        $this->courier = $courier;
        $this->users = \App\Models\User::select('id', 'name')->get()->toArray();
        $this->branches = \Src\Branch\Models\Branch::select('id', 'name')->get()->toArray();
    }

  
    public function save()
    {
        $this->validate();

        $dto = CourierAdminDto::fromLiveWireModel($this->courier);
      
        $service = new CourierAdminService();
        DB::beginTransaction();
        try {
            switch ($this->action) {
                case Action::CREATE:
                    $user = $service->store($dto);
                    DB::commit();
                    $this->successFlash(__('Courier Created Successfully'));
                    return  redirect()->route('admin.couriers.index');

                case Action::UPDATE:
                    $service->update($this->user, $dto);
                    DB::commit();
                    $this->successFlash(__('Courier Updated Successfully'));
                    // return redirect()->back();
                    return redirect()->route('admin.couriers.index');

                default:
                    return $this->redirect(url()->previous());
            }
        } catch (\Exception $e) {
            logger($e);
            DB::rollBack();
            $this->addError('department_head', $e->getMessage());
        }
    }
}
