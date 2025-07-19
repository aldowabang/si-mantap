<?php

namespace App\Models;

use App\Models\Proyek;
use App\Models\Tahap;
use App\Models\Dokument;
use App\Models\Pengawas;
use Illuminate\Database\Eloquent\Factories\Factory;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoring extends Model
{
    /** @use HasFactory<\Database\Factories\MonitoringFactory> */
    use HasFactory;

 public function proyek()
{
    // Satu monitoring dimiliki oleh satu proyek
    return $this->belongsTo(Proyek::class, 'proyek_id');
}

public function dokuments()
{
    return $this->hasMany(Dokument::class, 'monitoring_id');
}

}
