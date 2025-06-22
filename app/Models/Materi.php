<?php

// app/Models/Materi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['kursus_id', 'judul', 'deskripsi', 'file'];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }
}