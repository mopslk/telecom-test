<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentTypeResource;
use App\Models\EquipmentType;
use Illuminate\Http\Request;

class EquipmentTypeController extends Controller
{
    public function index(Request $request)
    {
        return EquipmentTypeResource::collection(EquipmentType::search($request->input('q')));
    }
}
