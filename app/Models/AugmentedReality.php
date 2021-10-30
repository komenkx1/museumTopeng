<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AugmentedReality extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function getMarkerFileAttribute()
    {
        return $this->marker_file_url ?
            asset('/storage/' . $this->marker_file_url) :
            "";
    }
    public function getContentFileAttribute()
    {
        return $this->content_file_url ?
        asset('/storage/' . $this->content_file_url) :
          "";
    }
}
