<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function getThumbnailAttribute()
    {
        return $this->image_url ?
            asset('/storage/' . $this->image_url) :
            "";
    }
}
