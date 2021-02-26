<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
        'identificador' => $this->id,
        'titulo' => $this->title,
        'cover'=> $this->cover,
        'autores'=> $this->authors,
        ];
    }
}