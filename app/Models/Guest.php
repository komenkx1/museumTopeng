<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Guest extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = ["id"];

    public function transaksi()
    {
    	return $this->hasOne(Transaction::class);
    }
}
