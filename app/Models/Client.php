<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model

{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email_address',
        'phone_number',
        'address',
        'is_active',
    ];

    public function cargo()
    {
        return $this->hasMany(Cargo::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
