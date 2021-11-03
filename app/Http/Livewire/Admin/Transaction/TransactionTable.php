<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Mail\NotifikasiPembayaranSukses;
use App\Mail\NotifikasiPembayaranSuksesAR;
use App\Models\AugmentedRealityAccount;
use App\Models\Feauture;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class TransactionTable extends DataTableComponent
{
    protected $listeners = [
        'verification',
        'reject',
    ];

    public function columns(): array
    {
        return [
            Column::make('Transaction Id', 'session_ID')
                ->searchable(),
                Column::make('Customer', 'guest.name')
                ->searchable(),
                Column::make('Item', 'package.name')
                ->searchable(),
                Column::make('Price', 'package.price')
                ->format(function ($value, $column, $row) {
                    return view('admin.components.customRow.price', compact('row'));
                }),
                Column::make('Status', 'status')
                ->searchable(),
                Column::make('Paid At', 'paid_at')
                ->searchable(),
                Column::make('Payment Method', 'payment_method')
                ->searchable(),
            // Column::make('price'),
            Column::make('Action')
            ->format(function ($value, $column, $row) {
                if ($row->status == 'pending') {
                    return View('admin.components.actions.table-transaction', compact('row'));
                } else {
                    return '<i class="bi bi-patch-check-fill"></i>';
                }
            })->asHtml(),
        ];
        
    }
    public function query(): Builder
    {
        return Transaction::query()
        ->when($this->getFilter('start_date'), fn ($query, $start) => $query->where('created_at', '>=', $start))
        ->when($this->getFilter('end_date'), fn ($query, $end) => $query->where('created_at', '<=', $end))
        ->orderBy('id', 'desc');;
    }



    public function triggerConfirm($id)
{
    $this->confirm('Are you sure to verified this transaction?', [
        'toast' => false,
        'position' => 'center',
        'showConfirmButton' => true,
        'cancelButtonText' => "Close",
        'onConfirmed' => 'verification',
        'onCancelled' => 'cancelled',
        'inputAttributes' => ["transaction" => $id],
    ]);
}

public function triggerConfirmReject($id)
{
    $this->confirm('Are you sure to reject this transaction?', [
        'toast' => false,
        'position' => 'center',
        'showConfirmButton' => true,
        'cancelButtonText' => "Close",
        'onConfirmed' => 'reject',
        'onCancelled' => 'cancelled',
        'inputAttributes' => ["transaction" => $id],
    ]);
}

public function reject(Transaction $transaction)
{
    DB::beginTransaction();
    $transaction->update([
        'status' => 'rejected',
    ]);
    DB::commit();
    $this->alert('info', 'Transaction Rejected', [
        'position' =>  'top-end', 
        'timer' =>  3000,  
        'toast' =>  true, 
  ]);
}

public function verification(Transaction $transaction)
{
    DB::beginTransaction();
    $transaction->update([
        'status' => 'berhasil',
        "paid_at" => now()
    ]);
    $isAR = Feauture::where("id_package", $transaction->package->id)->where('name', 'LIKE', "%augmented reality%")->count();
    $password = substr(md5(uniqid($transaction->guest->id)), 0, 8);
    DB::commit();

    if ($transaction->status == "berhasil") {
        if ($isAR > 0 ) {
            $lastUserAr = AugmentedRealityAccount::create([
                "username" => $transaction->guest->id.time(),
                "password" => bcrypt($password)
            ]);
            Mail::to($transaction->guest->email)->send(new NotifikasiPembayaranSuksesAR($transaction,$lastUserAr,$password));
        }else {
            Mail::to($transaction->guest->email)->send(new NotifikasiPembayaranSukses($transaction));
        }
    }
    $this->alert('info', 'Transaction Verified', [
        'position' =>  'top-end', 
        'timer' =>  3000,  
        'toast' =>  true, 
  ]);
}

public function filters(): array
{
    return [
        'start_date' => Filter::make('Tanggal Awal')->date(),
        'end_date' => Filter::make('Tanggal Akhir')->date(),
    ];
}
}
