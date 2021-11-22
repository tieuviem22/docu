<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Offer() {
        return $this->belongsTo('App\Models\Models\Offer','foreign_key');
    }
}
