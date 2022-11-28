<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Appointment;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'country', 'county', 'city', 'address', 'phone', 'email'];

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
