<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ideas extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ideas_categories_id',
        'author',
        'title',
        'status',
        'active',
        'description',
        'likes',
        'file'
    ];
    protected $guarded = [];

    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Models\IdeasCategories');
    }
}
