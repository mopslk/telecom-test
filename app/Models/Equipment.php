<?php

namespace App\Models;

use App\Http\Resources\EquipmentResource;
use App\Services\MaskService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type_id',
        'serial_number',
        'description',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class);
    }

    public static function createEquipment(array $data): array
    {
        $result = [];
        foreach ($data as $value){
            $type = EquipmentType::findOrFail($value['type_id']);
            $value['serial_number'] = MaskService::mask($type->mask);
            $result[] = EquipmentResource::make(Equipment::create($value));
        }
        return $result;
    }

    public static function updateEquipment(array $data, Equipment $equipment): Equipment
    {
        $type = EquipmentType::findOrFail($data['type_id']);
        $data['serial_number'] = MaskService::mask($type->mask);
        $equipment->update($data);
        return $equipment;
    }

    public function scopeSearch($query, $q)
    {
        return $query->when($q, function ($query, $q) {
            return $query->where('serial_number', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%");
        })->paginate(10);
    }
}
