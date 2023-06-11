<?php

namespace App\Http\Resources\Coach;

use App\Http\Resources\Team\TeamNameResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'coach';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'birth' => $this->resource->birth,
            'team' => new TeamNameResource($this->resource->team)
        ];
    }
}
