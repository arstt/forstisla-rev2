<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;

class Nasabah extends Model
{
    use HasFactory, Multitenantable;

    protected $fillable = [
        'user_id',
        'id_nasabah',
        'nik',
        'nama',
        'alamat',
        'no_hp',
        'jenis_kelamin',

    ];

    public function alternative(){
        return $this->hasOne(Alternative::class);
    }
}
