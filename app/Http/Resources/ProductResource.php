<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id'            => $this->id,
            'title'         => $this->title,
            'price_netto'   => $this->price_netto,
            'price_brutto'  => $this->price_brutto,
            'vat'           => $this->vat,
            'stock'         => $this->stock,
            'barcode'       => $this->barcode,
            'images'        => $this->images,
            'description'   => $this->description,
        ];
    }
}
