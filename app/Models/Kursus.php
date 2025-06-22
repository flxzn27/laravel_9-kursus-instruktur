<?php
// app/Models/Kursus.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    protected $fillable = ['nama_kursus', 'durasi', 'instruktur_id', 'biaya'];

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
