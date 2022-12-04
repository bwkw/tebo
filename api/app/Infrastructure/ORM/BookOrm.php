<?php

namespace App\Infrastructure\ORM;

use Illuminate\Database\Eloquent\Model;

class BookOrm extends Model
{
    protected $table = "books";
    protected $guarded = ["id", "created_at", "updated_at"];
}
