<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    /** @use HasFactory<\Database\Factories\ShipFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_number',
        'capacity_in_tonnes',
        'type',
        'status',
        'is_active',
    ];

    /**
     * Get the crew members assigned to the ship.
     */
    public function crew()
    {
        return $this->hasMany(Crew::class);
    }
}
