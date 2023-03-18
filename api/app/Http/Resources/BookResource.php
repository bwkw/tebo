<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property $id
 * @property $title
 * @property $description
 * @property $cover_image_url
 * @property $page
 * @property $published_date
 * @property $created_at
 * @property $updated_at
 */
class BookResource extends JsonResource
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
            'cover_image_url' => $this->cover_image_url,
            'page' => $this->page,
            'published_date' => $this->published_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'authors' => $this->authors->pluck('name'),
            'publisher' => $this->publisher->name ?? null,
        ];
    }
}
