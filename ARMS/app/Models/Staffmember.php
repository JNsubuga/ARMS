<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffmember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'animalclass_id',
        'Names',
        'DoB',
        'NoK',
        'Address',
        'PoB',
        'title',
        'Qualification'
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('Names', 'like', '%' . request('search') . '%')
                ->orWhere('NoK', 'like', '%' . request('search') . '%')
                ->orWhere('Address', 'like', '%' . request('search') . '%')
                ->orWhere('PoB', 'like', '%' . request('search') . '%')
                ->orWhere('title', 'like', '%' . request('search') . '%')
                ->orWhere('Qualification', 'like', '%' . request('search') . '%');
        }
    }

    public function Animals()
    {
        return $this->hasMany(Animal::class);
    }

    public function Animalclass()
    {
        return $this->belongsTo(Animalclass::class);
    }
}
