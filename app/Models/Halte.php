<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halte extends Model
{
    use HasFactory;

    protected $table = 'halte';

    protected $primaryKey = 'id';

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_rute');
    }
}
