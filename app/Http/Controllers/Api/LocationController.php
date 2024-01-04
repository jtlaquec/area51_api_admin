<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use App\Models\Province;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DistrictResource;
use App\Http\Resources\Api\ProvinceResource;
use App\Http\Resources\Api\DepartmentResource;

class LocationController extends Controller
{
    public function listarDepartamentos(Request $request)
    {
        try {
            $departments = Department::get();
            return DepartmentResource::collection($departments);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos del departamento. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function listarProvincias(Request $request)
    {
        try {
            $provinces = Province::get();
            return ProvinceResource::collection($provinces);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos del departamento. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function listarDistritos(Request $request)
    {
        try {
            $districts = District::get();
            return DistrictResource::collection($districts);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos del departamento. Detalles: ' . $e->getMessage()], 500);
        }
    }


    public function listarProvinciasPorDepartamento($departmentId)
    {

        try {
            $provinces = Province::where('department_id', $departmentId)->get();
            return ProvinceResource::collection($provinces);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos del departamento. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function listarDistritosPorProvincia($provinceId)
    {
        try {
            $districts = District::where('province_id', $provinceId)->get();
            return DistrictResource::collection($districts);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos del departamento. Detalles: ' . $e->getMessage()], 500);
        }
    }

}
