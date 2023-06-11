<?php

namespace App\Http\Resources\Team;

use App\Http\Resources\Coach\CoachCollection;
use App\Http\Resources\Player\PlayerCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'team';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'country' => $this->resource->country,
            'city' => $this->resource->city,
            'founded' => $this->resource->founded,
            'sport' => $this->resource->sport,
            'coaches' => new CoachCollection($this->resource->coaches),
            'players' => new PlayerCollection($this->resource->players)
        ];
    }
}
