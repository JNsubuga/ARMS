<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'Unit', 'Abbriviation'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('Unit', 'like', '%' . request('search') . '%')
                ->orWhere('Abbriviation', 'like', '%' . request('search') . '%');
        }
    }

    public function Stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function Bincards()
    {
        return $this->hasMany(Bincard::class);
    }
}
