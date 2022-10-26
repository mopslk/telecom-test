<?php

namespace App\Http\Requests;

/**
 * @property int $type_id
 * @property int $serial_number
 * @property string $description
 */

class EquipmentUpdateRequest extends EquipmentStoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'type_id' => 'required|integer|exists:equipment_types,id',
            'description' => 'string|max:255',
        ];
    }
}
