<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bis extends Model
{
    use HasFactory;

    protected $table = 'bis';

    protected $primaryKey = 'id';

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_rute');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_bis');
    }

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'id_bis');
    }
}
