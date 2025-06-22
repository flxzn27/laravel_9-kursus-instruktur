<?php

// app/Models/Pendaftaran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = ['kursus_id', 'user_id', 'status'];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

