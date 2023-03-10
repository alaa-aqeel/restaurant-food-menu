<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'address',
        'work_time',
        'image',
        'description',
        'user_id',
        'phone_primary',
        'phone_secondary',
        'facebook_page_id',
        "map_url",
        "color_title",
        "color_text",
        "background"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
    ];


    /**
     * Get the user for the menu
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the categories for the menu
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Get the food for the menu
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    function food()
    {
        return $this->hasMany(Food::class);
    }
}
