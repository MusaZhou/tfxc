<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class GeneralController extends Controller
{
    public function emptyTableData(Request $request){
		$data = collect();
    	$result = collect();
    	
    	$result->put('data', $data);
    	
    	return $result->toJson();
	}
}
