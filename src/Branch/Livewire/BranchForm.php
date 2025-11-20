<?php

namespace Src\Branch\Livewire;

use App\Enums\Action;
use App\Traits\SessionFlash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\DB;
use Src\Branch\DTO\BranchAdminDto;
use Src\Branch\Models\Branch;
use Src\Branch\Service\BranchAdminService;

class BranchForm extends Component
{
    use SessionFlash, WithFileUploads;


    public ?Branch $branch;
    public ?Action $action;


    public function rules(): array
    {
        $rules = [
            'branch.name' => ['required'],
            'branch.code' => ["required"],
            'branch.address' => ["required"],
            'branch.latitude' => ["required"],
            'branch.longitude' => ["required"],
        ];

       
        return $rules;
    }

   

    public function render()
    {
        return view("Branch::livewire.form");
    }

    public function mount(Branch $branch, Action $action)
    {
        $this->action = $action;
        $this->branch = $branch;
    }

  
    public function save()
    {
        try {
        // Define your validation rules
        $this->validate();

} catch (\Illuminate\Validation\ValidationException $e) {
    // Catch validation exceptions and dd the errors
    dd($e->errors()); // Returns an array of validation error messages
} catch (\Exception $e) {
    // Catch any other exceptions and dd the message
    dd($e->getMessage());
}
        $this->validate();

        $dto = BranchAdminDto::fromLiveWireModel($this->branch);
      
        $service = new BranchAdminService();
        DB::beginTransaction();
        try {
            switch ($this->action) {
                case Action::CREATE:
                    $user = $service->store($dto);
                    DB::commit();
                    $this->successFlash(__('Branch Created Successfully'));
                    return  redirect()->route('admin.branches.index');

                case Action::UPDATE:
                    $service->update($this->branch, $dto);
                    DB::commit();
                    $this->successFlash(__('Branch Updated Successfully'));
                    // return redirect()->back();
                    return redirect()->route('admin.branches.index');

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
