<?php

namespace App\Http\Resources;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'color' => $this->color,
            'textColor' => $this->textColor,
            'backgroundColor' => $this->backgroundColor,
            'start' => Carbon::make($this->start)->format('Y-m-d H:i:s'),
            'end' => Carbon::make($this->end)->format('Y-m-d H:i:s'),
         ];
    }
}
