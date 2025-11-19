<?php

namespace Src\Courier\Livewire;


use Illuminate\Database\Eloquent\Builder;
use App\Traits\SessionFlash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Maatwebsite\Excel\Facades\Excel;
use Src\Courier\Models\Courier;
use Src\Courier\Service\CourierAdminService;
use Src\Users\Exports\UsersExport;
use App\Models\User;
use Src\Users\Service\UserAdminService;

class CourierTable extends DataTableComponent
{
    use SessionFlash;
    protected $model = Courier::class;
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
        return Courier::query()
           
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC');
    }
    public function filters(): array
    {
        return [];        

    }
    public function columns(): array
    {
        $columns = [
            Column::make("User", "user_id")
                ->searchable(),
            Column::make("Branch", "branch_id")
                ->searchable(),
            Column::make("vehicle_number", "vehicle_number")
                ->searchable(),
            Column::make("contact_number", "contact_number")
                ->searchable(),
            Column::make("active", "active")
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
        
        return redirect()->route('admin.couriers.edit', ['id' => $id]);
    }
    public function delete($id)
    {
       
        $service = new Courier();
        $service->delete(Courier::findOrFail($id));
        $this->successFlash("Courier Deleted Successfully");
    }
    public function deleteSelected()
    {
        $service = new CourierAdminService();
        foreach ($this->getSelected() as $itemId) {
            $service->delete(Courier::findOrFail($itemId));
        }
        $this->clearSelected();
    }



    public function toggleStatus($id)
    {
        $user = Courier::find($id);
        $service = new CourierAdminService();
        $service->toggleStatus($user);
    }

}
