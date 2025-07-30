<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'cargo_id',
        'ship_id',
        'departure_date',
        'arrival_date',
        'status',
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }
}

