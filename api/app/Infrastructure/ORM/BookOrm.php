<?php

namespace App\Infrastructure\ORM;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $imageUrl,
 * @property int $page,
 * @property CarbonImmutable $publishedDate,
 * @property int $authorId,
 * @property int $publisherId,
 */
class BookOrm extends Model
{
    protected $table = "books";
    protected $guarded = ["id", "created_at", "updated_at"];
}
