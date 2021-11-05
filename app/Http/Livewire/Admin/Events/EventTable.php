<?php

namespace App\Http\Livewire\Admin\Events;

use App\Models\Event;
use App\Models\Feauture;
use App\Models\Package;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EventTable extends DataTableComponent
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
            Column::make('Action')
            ->format(function ($value, $column, $row) {
                $url = Route('admin.events.edit',['event'=>$row->id]);
                return View('admin.components.actions.table-default-action', compact('row','url'));
            }),
        ];
        
    }

    public function query(): Builder
    {
        return Event::query();
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

public function destroy(Event $event)
{
    DB::beginTransaction();
    Storage::delete('public/' . $event->image_url);
    $event->delete();
    DB::commit();
    $this->alert('info', 'Data Deleted', [
        'position' =>  'top-end', 
        'timer' =>  3000,  
        'toast' =>  true, 
  ]);
}

}
