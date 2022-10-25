<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentStoreRequest;
use App\Http\Requests\EquipmentUpdateRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EquipmentController extends Controller
{
    /**
     * Вывод списка оборудования с пагинацией
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return EquipmentResource::collection(Equipment::search($request->input('q')));
    }

    /**
     * Создание записи нового оборудования
     *
     * @param EquipmentStoreRequest $request
     * @return JsonResponse
     */
    public function store(EquipmentStoreRequest $request)
    {
        return $this->apiResponse(Equipment::createEquipment($request->validated()));
    }

    /**
     * Вывод информации определенного оборудования
     *
     * @param  Equipment $equipment
     * @return Response
     */
    public function show(Equipment $equipment)
    {
        return EquipmentResource::make($equipment);
    }

    /**
     * Обновление информации определенного оборудования
     *
     * @param EquipmentUpdateRequest $request
     * @param Equipment $equipment
     * @return JsonResponse
     */
    public function update(EquipmentUpdateRequest $request, Equipment $equipment)
    {
        $equipment->update($request->validated());
        return $this->apiResponse(EquipmentResource::make($equipment));
    }

    /**
     * Удаление записи определенного оборудования
     *
     * @param Equipment $equipment
     * @return JsonResponse
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return $this->apiResponse($equipment);
    }
}
