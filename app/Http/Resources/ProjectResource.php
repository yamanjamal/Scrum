<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'dead_line'     =>$this->dead_line,
            'teamleader'    =>new UserResource($this->whenloaded('TeamLeader')),
            'requirments'   =>RequirmentResource::collection($this->whenloaded('Requirments')),
            'srs'           =>SrsResource::collection($this->whenloaded('SRSs')),
        ];
    }
}
