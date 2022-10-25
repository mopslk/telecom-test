<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class EquipmentResource extends BaseEquipmentResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request),[
            'equipment_type' => [
                'id' => $this->type->id,
                'name' => $this->type->name,
            ],
            'serial_number' => $this->serial_number,
            'description' => $this->description,
        ]);
    }
}
