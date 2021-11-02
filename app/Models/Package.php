<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $guarded =["id"];

    public function feautures()
    {
        return $this->hasMany(Feauture::class,"id_package");
    }

    public function transaction()
    {
        return $this->hasOne(Feauture::class);
    }
}
