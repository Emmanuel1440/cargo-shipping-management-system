<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    protected $fillable = [
        'ship_id',
        'first_name',
        'last_name',
        'role',
        'phone_number',
        'nationality',
        'is_active',
    ];

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }
}

