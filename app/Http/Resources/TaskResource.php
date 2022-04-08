<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'id'            =>$this->id,
            'title'         =>$this->title,
            'description'   =>$this->description,
            'requirment_id' =>$this->requirment_id,
            'developer'    =>new UserResource($this->whenloaded('Developer')),
            'comments'      =>CommentResource::collection($this->whenloaded('Comments')),
        ];
    }
}
