<?php

namespace Src\Users\Livewire;

use App\Enums\Action;
use App\Traits\SessionFlash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Src\Users\DTO\UserAdminDto;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Src\Users\Service\UserAdminService;

class UserForm extends Component
{
    use SessionFlash, WithFileUploads;

    public $user_password;
    public ?User $user;
    public ?Action $action;

    public $userSignature;
    public $userSignatureUrl;
    public $uploadedSignaturePath; 

    public function rules(): array
    {
        $rules = [
            'user.name' => ['required'],
            'user.email' => ["required", "email"],
            'user.mobile_no' => ['nullable', 'string', 'max:10', 'unique:users,mobile_no'],
        ];

        if ($this->action == Action::CREATE) {
            $rules['user.email'] = "unique:users,email|required";
            $rules['user_password'] = ['required', 'min:6'];
        } elseif ($this->action == Action::UPDATE) {
            $rules['user.email'] = [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ];
            $rules['user.mobile_no'] = ['nullable', 'string', 'max:10'];
        }

        return $rules;
    }

   

    public function render()
    {
        return view("Users::livewire.form");
    }

    public function mount(User $user = null, Action $action, $id = null)
    {
        $this->action = $action;

        if ($this->action == Action::CREATE) {
            $this->user = new User();
        } else {
            $this->user = $user;
            $this->handleFileUpload(null, 'signature', 'userSignatureUrl');
        }
    }

    public function updatedUserSignature()
    {

        $this->handleFileUpload($this->userSignature, 'signature', 'userSignatureUrl');
    }

    public function handleFileUpload($file = null, string $modelField, string $urlProperty)
    {
        if (!$file) return;

        $this->validate([
            'userSignature' => 'image|max:2048',
        ]);

        $path = $file->store('signatures', 'public');

        $this->$urlProperty = asset('storage/' . $path);
        $this->uploadedSignaturePath = $path;
    }



    public function save()
    {
        $this->validate();

        if ($this->uploadedSignaturePath) {
            $this->user->signature = $this->uploadedSignaturePath;
        }

        if (!empty($this->user_password)) {
            $this->user->password = $this->user_password;
        }

        $dto = UserAdminDto::fromLiveWireModel($this->user);
      
        $service = new UserAdminService();
        DB::beginTransaction();
        try {
            switch ($this->action) {
                case Action::CREATE:
                    $user = $service->store($dto);
                    DB::commit();
                    $this->successFlash(__('users::users.user_created_successfully'));
                    return  redirect()->route('admin.users.index');

                case Action::UPDATE:
                    $service->update($this->user, $dto);
                    DB::commit();
                    $this->successFlash(__('users::users.user_updated_successfully'));
                    // return redirect()->back();
                    return redirect()->route('admin.users.index');

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
