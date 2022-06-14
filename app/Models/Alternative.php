<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;
use App\Models\Nasabah;
use App\Models\User;

class Alternative extends Model
{
    use HasFactory, Multitenantable;

    protected $guards = [];

    protected $fillable = [
        'user_id',
        'nasabah_id',
        'nilai_jaminan',
        'nilai_pendapatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    public function score()
    {
        return $this->hasMany(AlternativeScore::class);
    }
}
