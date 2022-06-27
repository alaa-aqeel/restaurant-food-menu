<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'menu_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'menu_id',
    ];


    /**
     * Get the menu for the category
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the food for the category
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    function food()
    {
        return $this->hasMany(Food::class);
    }
}
