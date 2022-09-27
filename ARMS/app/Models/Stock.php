<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'Quantity', 'unit_id'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('Quantity', 'like', '%' . request('search') . '%');
        }
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function Unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
