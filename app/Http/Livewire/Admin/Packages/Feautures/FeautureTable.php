<?php

namespace App\Http\Livewire\Admin\Packages\Feautures;

use App\Models\Feauture;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class FeautureTable extends DataTableComponent
{
    public $package;
    public $selectedFeauture;
    public $name;

    public array $perPageAccepted = [5];

    protected $listeners = [
        'destroy',
    ];

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Action')
                ->format(function ($value, $column, $row) {
                    return View('admin.components.actions.table-feauture', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return Feauture::where("id_package", $this->package->id);
    }


    public function modalsView(): string
    {
        return 'admin.components.modals.modal-feauture-edit';
    }

    public function select(Feauture $feauture)
    {
        $this->name = $feauture->name;
        $this->selectedFeauture = $feauture;

        $this->dispatchBrowserEvent('OpenModalDetail');
    }

    public function update(Feauture $feauture)
    {
        $this->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'name field is required',

            ]
        );

        $feauture->update([
            "name" => $this->name
        ]);
        $this->dispatchBrowserEvent('CloseModalDetail');
        $this->alert('info', 'Data updates', [
            'toast' => true,
            'timer' =>  3000,
        ]);
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
            'inputAttributes' => ["feauture" => $id],
        ]);
    }

    public function destroy(Feauture $feauture)
    {
        $feauture->delete();
        $this->alert('info', 'Data Deleted', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
        ]);
    }
}
