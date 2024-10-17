<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catalog extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'description'
    ];

    protected static function boot() {
        parent::boot();


        static::creating(function ($catalog) {
            $catalog->slug = Str::slug($catalog->title); // Correct variable
        });


        static::updating(function ($catalog) {
            $catalog->slug = Str::slug($catalog->title); // Correct variable
        });

    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);

    }

}
