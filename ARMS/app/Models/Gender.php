<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'Gender'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('Gender', 'like', '%' . request('search') . '%');
        }
    }

    public function Animals()
    {
        return $this->hasMany(Animal::class);
    }
}
