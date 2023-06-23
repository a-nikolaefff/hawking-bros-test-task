<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    /**
     * The name of the table in the database
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'guid',
            'title',
            'link',
            'description',
            'publication',
            'image_path',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts
        = [
            'publication' => 'datetime',
        ];


    /**
     * The tags of the news
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }


    /**
     * The likes and dislikes of the news
     *
     * @return BelongsToMany
     */
    public function likes(): HasMany {
        return $this->hasMany(Like::class);
    }
}
