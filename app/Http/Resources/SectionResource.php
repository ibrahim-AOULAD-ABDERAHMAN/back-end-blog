<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'id'             => $this->id,
            'section_title'  => $this->section_title,
            'section_body'   => $this->section_body,
            // 'created_at'    => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
