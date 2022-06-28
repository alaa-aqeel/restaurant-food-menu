<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'image',
        'price',
        'is_available',
        'description',
        'category_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'category_id',
    ];


    /**
     * Get the category for the a food
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
