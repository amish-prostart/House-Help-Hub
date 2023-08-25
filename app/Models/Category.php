<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name','status'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:categories,name',
        'image' => 'required',
    ];

    const COLLECTION_CATEGORY_PICTURES = 'category_photo';

    protected $with = ['media'];
    protected $appends = ['category_url'];

    /**
     * @return mixed
     */
    public function getCategoryUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::COLLECTION_CATEGORY_PICTURES)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/images/avatar.png');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }
}
