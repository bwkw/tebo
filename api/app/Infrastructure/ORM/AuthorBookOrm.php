<?php

namespace App\Infrastructure\ORM;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id,
 * @property int $author_id,
 * @property int $book_id,
 */
class AuthorBookOrm extends Model
{
    protected $table = 'author_book';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
