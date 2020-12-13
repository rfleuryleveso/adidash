<?php

namespace App\Http\Resources;

use App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'name' => $this->name,
			'users' => UserResource::collection($this->users),
			'status' => $this->status,
			'ended_at' => $this->ended_at,
			'ends_at' => $this->ends_at,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
