<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Tahap;
use App\Models\Monitoring;

class Proyek extends Model
{
    /** @use HasFactory<\Database\Factories\ProyekFactory> */
    use HasFactory;
    // Satu proyek dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu proyek punya banyak monitoring
    public function monitorings()
    {
        return $this->hasMany(Monitoring::class, 'proyek_id');
    }

    public function tahaps()
    {
        return $this->hasMany(Tahap::class, 'proyek_id');
    }

    // Satu proyek punya satu user pemengang yang mengelola proyek ini
    public function pemegang()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
