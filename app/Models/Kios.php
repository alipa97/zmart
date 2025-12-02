<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kios extends Model
{
    use HasFactory;

    protected $table = 'kios';

    // Tentukan field yang bisa diisi melalui mass assignment
    protected $fillable = [
        'nomor_kios',
        'nama_kios', 
        'no_hp', 
        'alamat', 
        'rt', 
        'kelurahan', 
        'kecamatan', 
        'keterangan',
        'foto',
        'pemilik_id',
        'latitude',
        'longitude',
        'tahun',
    ];

    // Relasi: Kios dimiliki oleh satu User
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class);
    }

    public function infaqKios()
    {
        return $this->hasMany(InfaqKios::class);
    }
}
