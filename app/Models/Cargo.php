<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'weight',
        'type',
        'client_id',
        'origin_port',
        'destination_port',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function origin()
    {
        return $this->belongsTo(Port::class, 'origin_port');
    }

    public function destination()
    {
        return $this->belongsTo(Port::class, 'destination_port');
    }
}
