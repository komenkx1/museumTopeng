<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function guest()
    {
    	return $this->belongsTo(Guest::class,"id_guest");
    }

    public function package()
    {
    	return $this->belongsTo(Package::class,"id_package");
    }
}
