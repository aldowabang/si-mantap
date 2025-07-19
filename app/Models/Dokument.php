<?php

namespace App\Models;
use App\Models\Monitoring;

use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class dokument extends Model
{
public function monitoring()
{
    return $this->belongsTo(Monitoring::class, 'monitoring_id');
}

public function tahap()
{
    return $this->belongsTo(Tahap::class, 'tahap_id');

}



}
