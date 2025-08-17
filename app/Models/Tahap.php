<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tahap extends Model
{
    function monitorings()
    {
        // Satu tahap dapat memiliki banyak monitoring
        return $this->hasMany(Monitoring::class, 'tahap_id');
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
