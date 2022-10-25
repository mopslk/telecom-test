<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentTypeResource;
use App\Models\EquipmentType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EquipmentTypeController extends Controller
{
    /**
     * Вывод списка типов оборудования с пагинацией
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return EquipmentTypeResource::collection(EquipmentType::search($request->input('q')));
    }
}
