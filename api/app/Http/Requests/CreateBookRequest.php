<?php

namespace App\Http\Requests;

use App\Domain\Book\BookEntity;

/**
 * @property $title
 * @property $description
 * @property $cover_image_url
 * @property $page
 * @property $published_date
 * @property $publisher_id
 */
class CreateBookRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:16384',
            'cover_image_url' => 'required|string|max:255',
            'page' => 'required|integer',
            'published_date' => 'required|date',
            'publisher' => 'required|string|max:255',
        ];
    }

    public function toEntity(): BookEntity
    {
        return BookEntity::constructNewInstance(
            $this->title,
            $this->description,
            $this->cover_image_url,
            $this->page,
            $this->published_date,
            $this->publisher_id,
        );
    }
}
