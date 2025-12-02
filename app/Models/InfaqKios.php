<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfaqKios extends Model
{
    use HasFactory;

    /**
     * Nama tabel jika berbeda dengan nama model dalam bentuk plural.
     *
     * @var string
     */
    protected $table = 'infaq_kios';

    /**
     * Kolom-kolom yang bisa diisi.
     *
     * @var array
     */
    protected $fillable = [
        'kios_id',
        'nominal',
        'tanggal',
        'via',
    ];

    /**
     * Relasi ke model Kios.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kios()
    {
        return $this->belongsTo(Kios::class);
    }
}
