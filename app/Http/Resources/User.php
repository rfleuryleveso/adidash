<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Group as GroupResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->fullName,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'classgroup' => new Group($this->getClassGroup())
        ];
    }
}
