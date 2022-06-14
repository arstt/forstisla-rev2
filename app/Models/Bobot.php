<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bobot extends Model
{
    use HasFactory;
    protected $table = 'bobots';

    protected $fillable = [
        'kriteria_id',
        'bobot',
        'deskripsi',
    ];

    public function kriterias()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }


}
