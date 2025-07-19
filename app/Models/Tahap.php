<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tahap extends Model
{
    public function monitorings()
    {
        return $this->hasMany(Monitoring::class);
    }

    public function dokuments()
    {
        return $this->hasMany(Dokument::class, 'tahap_id');
    }

    

    protected $fillable = [
        'proyek_id',
        'namaTahap',
        'statusTahap',
    ];

}
