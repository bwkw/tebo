<?php

namespace App\Infrastructure\ORM;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */

class PublisherOrm extends Model
{
    protected $table = "publishers";
    protected $guarded = ["id", "created_at", "updated_at"];
}
