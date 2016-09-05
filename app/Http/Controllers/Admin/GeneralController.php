<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Province;

class GeneralController extends Controller
{
    public function getCitiesByProvinceId(Request $request){
    	$cities = Province::find($request->provinceId)->cities;
    	
    	$result = collect();
    	$result->put('status', 1);
    	$result->put('data', ['cities' => $cities]);
    	
    	return $result->toJson();
	}
}
