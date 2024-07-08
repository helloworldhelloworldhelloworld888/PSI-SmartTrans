<?php

namespace App\Models;

use App\Enums\TopikEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pengguna',
        'topik',
        'deskripsi',
        'status',
        'tanggal_pengaduan',
        'tanggal_penanganan',
        'tanggal_selesai',
    ];

    protected $appends = [
        'topik_name',
    ];

    protected $casts = [
        'tanggal_pengaduan' => 'datetime',
        'topik' => TopikEnum::class,
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id');
    }

    public function getTopikNameAttribute()
    {
        return $this->topik;
    }
}
