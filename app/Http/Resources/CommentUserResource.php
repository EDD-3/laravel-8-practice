<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CommentUserResource extends JsonResource
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
            'name' => $this->name,
            //Using conditionals to display a field
            /**
             * Only works when authenticated through an API
             * 'email' => $this->when(Auth::user()->is_admin, $this->email),
             */
            //Simple test
            'email' => $this->when(true, $this->email),
        ];
    }
}
