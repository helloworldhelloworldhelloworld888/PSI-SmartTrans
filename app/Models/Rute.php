<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;

    protected $table = 'rute';

    protected $primaryKey = 'id';

    public function buses()
    {
        return $this->hasMany(Bis::class, 'id_rute');
    }

    public function halteAwal()
    {
        return $this->belongsTo(Halte::class, 'id_halte_awal');
    }

    public function halteAkhir()
    {
        return $this->belongsTo(Halte::class, 'id_halte_akhir');
    }

    public function halteById($id)
    {
        return $this->belongsTo(Halte::class, 'id_halte_' . $id);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_rute');
    }
}
