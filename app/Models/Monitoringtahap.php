<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoringtahap extends Model
{
    /** @use HasFactory<\Database\Factories\MonitoringtahapFactory> */
    use HasFactory;

    protected $fillable = [
        'monitoring_id',
        'tahap_id',
    ];

    // Define relationships if needed
    public function monitoring()
    {
        return $this->belongsTo(Monitoring::class);
    }

    public function tahap()
    {
        return $this->belongsTo(Tahap::class);
    }
}
