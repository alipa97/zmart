<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    protected $table = 'pemilik';

    protected $fillable = [
        'nama_pemilik',
        'tempat_lahir',
        'tanggal_lahir'
    ];

    public function kios()
    {
        return $this->hasMany(Kios::class, 'pemilik_id');
    }
}
