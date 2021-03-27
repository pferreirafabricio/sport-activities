<?php

namespace App\Http\Resources\SportActivities;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResources extends JsonResource
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
            'start' => "{$this->date} {$this->start_hour}",
            'end' => "{$this->date} {$this->end_hour}",
            'title' => $this->name,
            'content' => $this->description,
        ];
    }
}
