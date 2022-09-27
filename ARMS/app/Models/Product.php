<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'Name', 'unitPrice'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('Name', 'like', '%' . request('search') . '%');
        }
    }

    public function Stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function Bincards()
    {
        return $this->hasMany(Bincard::class);
    }
}
