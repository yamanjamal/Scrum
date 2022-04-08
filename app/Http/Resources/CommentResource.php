<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'id'        =>$this->id,
            'content'   =>$this->content,
            'task_id'   =>$this->task_id,
            'user'      =>new UserResource($this->whenloaded('User')),
            'replays'   =>CommentResource::collection($this->whenloaded('Comments')),
        ];
    }
}
