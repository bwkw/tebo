<?php

namespace App\Infrastructure\ORM;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class AuthorOrm extends Model
{
    protected $table = "authors";
    protected $guarded = ["id", "created_at", "updated_at"];
}
