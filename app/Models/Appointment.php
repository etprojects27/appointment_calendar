<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Consultant;

class Appointment extends Model
{
    protected $fillable = ['start_time', 'end_time','date','client_id', 'consultant_id'];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function consultant() {
        return $this->belongsTo(Consultant::class);
    }
}
