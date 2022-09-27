<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'animalclass_id',
        'staffmember_id',
        'maleParent',
        'femaleParent',
        'gender_id',
        'breed',
        'DoJ'
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('breed', 'like', '%' . request('search') . '%')
                ->orWhere('maleParent', 'like', '%' . request('search') . '%')
                ->orWhere('femaleParent', 'like', '%' . request('search') . '%')
                ->orWhere('DoJ', 'like', '%' . request('search') . '%');
        }
    }

    public function Animalclass()
    {
        return $this->belongsTo(Animalclass::class);
    }

    public function Staffmember()
    {
        return $this->belongsTo(Staffmember::class);
    }

    public function Gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function Healthyhistories()
    {
        return $this->hasMany(Healthyhistory::class);
    }
}
