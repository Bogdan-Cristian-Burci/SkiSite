<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Comment */
class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'aproved_status' => $this->aproved_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'user_id' => $this->user_id,
            'blog_post_id' => $this->blog_post_id,

            'user' => new UserResource($this->whenLoaded('user')),
            'blogPost' => new BlogPostResource($this->whenLoaded('blogPost')),
        ];
    }
}
