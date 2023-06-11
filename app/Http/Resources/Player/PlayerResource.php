<?php

namespace App\Http\Resources\Player;

use App\Http\Resources\Team\TeamNameResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'player';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'birth' => $this->resource->birth,
            'nationality' => $this->resource->nationality,
            'sport' => $this->resource->sport,
            'role' => $this->resource->role,
            '# of trophies' => $this->resource->trophies,
            'team' => new TeamNameResource($this->resource->team)
        ];
    }
}
