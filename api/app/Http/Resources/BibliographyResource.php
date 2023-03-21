<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property $id
 * @property $title
 * @property $description
 * @property $coverImageUrl
 * @property $page
 * @property $publishedDate
 * @property $authors
 * @property $publisher
 */
class BibliographyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'cover_image_url' => $this->coverImageUrl,
            'page' => $this->page,
            'published_date' => $this->publishedDate,
            'authors' => $this->authors,
            'publisher' => $this->publisher,
        ];
    }
}
