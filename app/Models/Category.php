<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'slug'
    ];

    public function categories()
    {
        return $this->belongsToMany(Catalog::class); // или Catalog::class, если это ваша логика
    }

}
