<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'external_id' => $this->external_id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'slug' => $this->slug,
            'show_in_slide' => $this->show_in_slide,
            'path_image' => $this->path_image,
            'path_image_thumbnail' => $this->path_image_thumbnail,
            'is_published' => $this->is_published,
            'date_published' => $this->date_published,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'created_at' => $this->external_created_at,
            'updated_at' => $this->external_updated_at,
            'category' => $this->category
        ];
    }
}
