<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IdeasCategories extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'description',
        'file'
    ];

    public function ideas(): HasMany
    {
        return $this->hasMany('App\Models\Ideas');
    }

}
