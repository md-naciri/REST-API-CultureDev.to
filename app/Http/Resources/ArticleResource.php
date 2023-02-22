<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content'=>$this->content,
            'description' => $this->description,
            'category' => new CategoryResource($this->category),
            'user' => new UserResource($this->user),
            'comments' => new CommentCollection($this->comments)
        ];
    }
}
