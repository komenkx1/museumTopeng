<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feauture extends Model
{
    use HasFactory;
    protected $table = "feautures";
    protected $guarded =["id"];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
