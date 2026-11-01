<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'gallery'        => 'array',
            'review_images'  => 'array',
            'is_top_selling' => 'boolean',
            'is_popular'     => 'boolean',
            'is_active'      => 'boolean',
            'price'          => 'integer',
            'old_price'      => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort_order')->orderByDesc('id');
    }

    public static function url(?string $path): string
    {
        if (! $path) {
            return asset('images/placeholder.svg');
        }

        return Str::startsWith($path, ['http://', 'https://']) ? $path : asset($path);
    }

    public function getImageUrlAttribute(): string
    {
        return self::url($this->image);
    }

    /** Main image first, then the extra gallery images. */
    public function getGalleryUrlsAttribute(): array
    {
        $paths = array_values(array_filter(array_merge([$this->image], $this->gallery ?? [])));
        if (! $paths) {
            return [asset('images/placeholder.svg')];
        }

        return array_map(fn ($p) => self::url($p), $paths);
    }

    public function getReviewImageUrlsAttribute(): array
    {
        return array_map(fn ($p) => self::url($p), array_values(array_filter($this->review_images ?? [])));
    }

    public function getSaveAmountAttribute(): int
    {
        return ($this->old_price && $this->old_price > $this->price) ? $this->old_price - $this->price : 0;
    }

    public function getDiscountPercentAttribute(): int
    {
        return $this->save_amount > 0 ? (int) round($this->save_amount / $this->old_price * 100) : 0;
    }

    public static function uniqueSlug(string $source, ?int $ignoreId = null): string
    {
        $base = Str::slug($source) ?: 'product-' . Str::lower(Str::random(5));
        $slug = $base;
        $i = 2;
        while (self::query()->where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
