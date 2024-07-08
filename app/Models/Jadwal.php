<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $primaryKey = 'id';

    public function bis()
    {
        return $this->belongsTo(Bis::class, 'id_bis', 'id');
    }

    public function getJamKeberangkatanAttribute()
    {
        return [
            $this->jam_keberangkatan_1,
            $this->jam_keberangkatan_2,
            $this->jam_keberangkatan_3,
            $this->jam_keberangkatan_4,
        ];
    }
}
