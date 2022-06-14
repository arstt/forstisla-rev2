<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    use HasFactory;



    protected $fillable = [
        'nama',
        'tipe',
        'bobot',
        'deskripsi',
    ];

    public function bobots()
    {
        return $this->hasMany(Bobot::class);
    }
}
