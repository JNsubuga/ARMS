<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animalclass extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'className', 'section'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('className', 'like', '%' . request('search') . '%')
                ->orWhere('section', 'like', '%' . request('search') . '%');
        }
    }

    public function Animals()
    {
        return $this->hasMany(Animal::class);
    }

    public function Staffmembers()
    {
        return $this->hasMany(Staffmember::class);
    }
}
