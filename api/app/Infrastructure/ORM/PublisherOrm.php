<?php

namespace App\Infrastructure\ORM;

use Illuminate\Database\Eloquent\Model;

class PublisherOrm extends Model
{
    protected $table = "publishers";
    protected $guarded = ["id", "created_at", "updated_at"];
}
