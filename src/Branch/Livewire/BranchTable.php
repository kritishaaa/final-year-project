<?php

namespace Src\Branch\Livewire;


use Illuminate\Database\Eloquent\Builder;
use App\Traits\SessionFlash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Maatwebsite\Excel\Facades\Excel;
use Src\Branch\Models\Branch;
use Src\Branch\Service\BranchAdminService;
use Src\Users\Exports\UsersExport;
use App\Models\User;
use Src\Users\Service\UserAdminService;

class BranchTable extends DataTableComponent
{
    use SessionFlash;
    protected $model = Branch::class;
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableAttributes([
                'class' => "table table-bordered table-hover text-center",
            ])
            ->setAdditionalSelects(['id'])
            ->setPerPageAccepted([10, 25, 50, 100, 500])
            ->setSelectAllEnabled()
            ->setRefreshMethod('refresh');
    }
    public function builder(): Builder
    {
        return Branch::query()
           
           
            ->orderBy('created_at', 'DESC');
    }
    public function filters(): array
    {
        return [];
    }
    public function columns(): array
    {
        $columns = [
            Column::make("Name", "name")
                ->searchable(),
            Column::make("Address", "address")
                ->searchable(),
            Column::make("Code", "code")
                ->searchable(),
            Column::make("Longitude", "longitude")
                ->searchable(),
            Column::make("Latitude", "latitude")
                ->searchable(),
            
            
        ];

        // if (can('users edit') || can('users delete') || can('users manage')) {
            $actionsColumn = Column::make(__('Actions'))->label(function ($row, Column $column) {
                $buttons = '';

                // if (can('users edit')) {
                    $edit = '<button class="btn btn-primary btn-sm" wire:click="edit(' . $row->id . ')" ><i class="bx bx-pencil"></i></button>&nbsp;';
                    $buttons .= $edit;
                // }

                // if (can('users delete')) {
                    $delete = '<button type="button" class="btn btn-danger btn-sm" wire:confirm="Are you sure you want to delete this record?" wire:click="delete(' . $row->id . ')"><i class="bx bx-trash"></i></button>';
                    $buttons .= $delete;
                // }

                return $buttons;
            })->html();

            $columns[] = $actionsColumn;
        // }

        return $columns;
    }

    public function refresh() {}
    public function edit($id)
    {
        
        return redirect()->route('admin.branch.edit', ['id' => $id]);
    }
    public function delete($id)
    {
       
        $service = new Branch();
        $service->delete(Branch::findOrFail($id));
        $this->successFlash("Branch Deleted Successfully");
    }
    public function deleteSelected()
    {
        $service = new BranchAdminService();
        foreach ($this->getSelected() as $itemId) {
            $service->delete(Branch::findOrFail($itemId));
        }
        $this->clearSelected();
    }
    public function exportSelected()
    {
        $records = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new UsersExport($records), 'users.xlsx');
    }

    public function role($userId)
    {
        return redirect()->route('admin.users.role', ['id' => $userId]);
    }

    public function permission($userId)
    {
        return redirect()->route('admin.users.permission', ['id' => $userId]);
    }

    public function toggleStatus($id)
    {
        $user = User::find($id);
        $service = new UserAdminService();
        $service->toggleUserStatus($user);
    }

    public function manage(int $userId)
    {
        return redirect()->route('admin.users.manage', ['id' => $userId]);
    }
}
