<?php

namespace App\Infrastructure\ORM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 */
class AuthorOrm extends Model
{
    protected $table = "authors";
    protected $guarded = ["id", "created_at", "updated_at"];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(BookOrm::class);
    }
}
