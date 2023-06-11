<?php

namespace App\Http\Resources\Coach;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CoachCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'coaches';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
