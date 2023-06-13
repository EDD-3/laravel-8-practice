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
        // return parent::toArray($request);

        //Ovewriting the serialized method
        return [
            'id' => $this->id,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            //Limiting serialization to eager loading the user relation with the post
            'user' => new CommentUserResource($this->whenLoaded('user')),

            //Bad practice
            // 'user' => [
            //     'id' => $this->user->id,
            // ],
        ];
    }
}
