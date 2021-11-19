<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Country() {
        return $this->belongsTo('App\Models\Models\Country','foreign_key');
    }
    public function Network() {
        return $this->belongsTo('App\Models\Models\Network','foreign_key');
    }
}
