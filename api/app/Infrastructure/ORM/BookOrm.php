<?php

namespace App\Infrastructure\ORM;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $cover_image_url,
 * @property int $page,
 * @property CarbonImmutable $published_date,
 * @property int $publisher_id,
 */
class BookOrm extends Model
{
    protected $table = "books";
    protected $guarded = ["id", "created_at", "updated_at"];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(AuthorOrm::class);
    }

    public function getPublishedDateAttribute($value): CarbonImmutable
    {
        if ($value) {
            return new CarbonImmutable($value);
        }
        return $value;
    }
}
