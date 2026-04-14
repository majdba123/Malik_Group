<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Product extends Model
{
    public const STATUS_ACTIVE = 'active';

    public const STATUS_PENDING = 'pending';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'phone_number',
        'status',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function scopeFilterCatalog(Builder $query, Request $request, ?int $lockedCategoryId = null): Builder
    {
        if ($lockedCategoryId !== null) {
            $query->where('category_id', $lockedCategoryId);
        } else {
            $query->when($request->filled('category_id'), fn ($q) => $q->where('category_id', $request->integer('category_id')));
        }

        return $query
            ->when($request->filled('q'), function ($q) use ($request): void {
                $term = '%'.$request->string('q')->trim()->toString().'%';
                $q->where('name', 'like', $term);
            })
            ->when($request->filled('min_price') && is_numeric($request->input('min_price')), function ($q) use ($request): void {
                $q->where('price', '>=', (float) $request->input('min_price'));
            })
            ->when($request->filled('max_price') && is_numeric($request->input('max_price')), function ($q) use ($request): void {
                $q->where('price', '<=', (float) $request->input('max_price'));
            });
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }
}
