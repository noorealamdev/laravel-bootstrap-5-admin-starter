<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'html',
        'shopify',
        'react',
        'vue',
        'svelte',
        'screenshot',
        'price',
        'is_active',
        'is_featured',
        'has_image',
        'tags',
        'liked',
        'views',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
