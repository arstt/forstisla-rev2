<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'kriteria_id',
        'bobot_id',
    ];

    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }
    public function bobot()
    {
        return $this->belongsTo(Bobot::class);
    }
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
