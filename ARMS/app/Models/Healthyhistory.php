<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Healthyhistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'animal_id',
        'vetdoctor_id',
        'Daignosis',
        'Treatment',
        'Recommendation',
        'DoR'
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('Daignosis', 'like', '%' . request('search') . '%')
                ->orWhere('Treatment', 'like', '%' . request('search') . '%')
                ->orWhere('Recommendation', 'like', '%' . request('search') . '%')
                ->orWhere('DoR', 'like', '%' . request('search') . '%');
        }
    }

    public function Animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function Vetdoctor()
    {
        return $this->belongsTo(Vetdoctor::class);
    }
}
