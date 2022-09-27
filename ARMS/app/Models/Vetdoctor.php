<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vetdoctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'Names',
        'speciality',
        'job_status',
        'Address'
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('Names', 'like', '%' . request('search') . '%')
                ->orWhere('speciality', 'like', '%' . request('search') . '%')
                ->orWhere('job_status', 'like', '%' . request('search') . '%')
                ->orWhere('Address', 'like', '%' . request('search') . '%');
        }
    }

    public function Healthyhistories()
    {
        return $this->hasMany(Healthyhistory::class);
    }
}
