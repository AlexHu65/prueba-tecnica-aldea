<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
        'key',
    ];

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class)->whereHas('user', function ($query) {
            $query->where('user_id', auth('api')->id());
        });
    }

    public function countBills()
    {
        return $this->bills()->count();
    }
    
}
