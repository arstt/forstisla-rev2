<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturePlan extends Model
{
    use HasFactory;

    protected $table='feature_plan';
    protected $fillable = [
        'feature_id',
        'plan_id',
        'max_amount',
    ];

    public function features()
    {
        return $this->belongsTo(Feature::class, 'feature_id');
    }
}
