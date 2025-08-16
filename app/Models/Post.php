<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, HasUuids, HasSlug;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Use slug for route model binding
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Slug options using Spatie
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    protected static function booted()
{
    static::creating(function ($post) {
        if (Auth::check()) {
            $post->user_id = Auth::id();
        }
    });
}

    // 🔗 Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
