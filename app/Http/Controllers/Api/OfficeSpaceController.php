<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfficeSpaceResource;
use Illuminate\Http\Request;
use App\Models\OfficeSpace;

class OfficeSpaceController extends Controller
{
    public function index()
    {
        $cities = OfficeSpace::withCount('city')->get();
        return OfficeSpaceResource::collection($cities);
    }

    public function show(City $city)
    {
        $city->load(['city', 'photos', 'benefits']);
        return new OfficeSpaceResource($city);
    }
}
