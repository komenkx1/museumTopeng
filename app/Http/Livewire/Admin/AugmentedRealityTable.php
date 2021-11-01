<?php

namespace App\Http\Livewire\Admin;

use App\Models\AugmentedReality;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;


class AugmentedRealityTable extends DataTableComponent
{
    protected $listeners = [
        'destroy',
    ];
    public $selectedAR;
    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Mark ID', 'marker_id'),
            Column::make('Action')
                ->format(function ($value, $column, $row) {
                    return View('admin.components.actions.table-ar', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return AugmentedReality::query();
    }


    public function modalsView(): string
    {
        return 'admin.components.modals.modal-ar-detail';
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
            'inputAttributes' => ["augmentedReality" => $id],
        ]);
    }

    public function select(AugmentedReality $augmentedReality)
    {
        $this->selectedAR = $augmentedReality;
        $this->dispatchBrowserEvent('OpenModalDetail');
    }
    public function destroy(AugmentedReality $augmentedReality)
    {
        // dd();
        DB::beginTransaction();
        Storage::delete('public/' . $augmentedReality->marker_file_url);
        Storage::delete('public/' . $augmentedReality->content_file_url);
        $augmentedReality->delete();
        DB::commit();
        $this->alert('info', 'Data Deleted', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
        ]);
    }
}
