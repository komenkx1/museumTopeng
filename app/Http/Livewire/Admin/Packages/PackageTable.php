<?php

namespace App\Http\Livewire\Admin\Packages;

use App\Models\Feauture;
use App\Models\Package;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PackageTable extends DataTableComponent
{

    protected $listeners = [
        'destroy',
    ];

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('price'),
            Column::make('Action')
            ->format(function ($value, $column, $row) {
                return View('admin.components.actions.table-package', compact('row'));
            }),
        ];
        
    }

    public function query(): Builder
    {
        return Package::query();
    }

    public function triggerConfirm($id)
{
    $this->confirm('Are you sure to delete this data?', [
        'toast' => false,
        'position' => 'center',
        'showConfirmButton' => true,
        'cancelButtonText' => "Close",
        'onConfirmed' => 'destroy',
        'onCancelled' => 'cancelled',
        'inputAttributes' => ["package" => $id],
    ]);
}

public function destroy(Package $package)
{
    DB::beginTransaction();
    Feauture::where("id_package",$package->id)->delete();
    $package->delete();
    DB::commit();
    $this->alert('info', 'Data Deleted', [
        'position' =>  'top-end', 
        'timer' =>  3000,  
        'toast' =>  true, 
  ]);
}

}
