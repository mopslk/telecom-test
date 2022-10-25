<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentTypeResource;
use App\Models\EquipmentType;
use Illuminate\Http\Request;

class EquipmentTypeController extends Controller
{
    public function index(Request $request) {
        $equipmentTypes = EquipmentType::query()
            ->when($request->has('q'),
                function ($query) use ($request) {
                    $query->search($request->input('q'));
                })->paginate(10);

        return EquipmentTypeResource::collection($equipmentTypes);
    }
}
