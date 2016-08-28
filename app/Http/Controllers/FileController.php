<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use Log;

class FileController extends Controller
{
    public function downloadImage(Request $request, $relative_url){
//     	Log::info('request url:'.$request->path());
		if(Storage::exists($relative_url)){
			$file = Storage::get($relative_url);
			$extension = explode('.', $relative_url)[1];
			$mime_type = 'image/jpeg';
			if(strcasecmp($extension, 'jpg') === 0){
				$mime_type = 'image/jpeg';
			}else if(strcasecmp($extension, 'png') === 0){
				$mime_type = 'image/png';
			}
			
			return (new Response($file, 200))->header('Content-Type', $mime_type);
		}else{
			return (new Response('image could not be found', 404));
		}
		
		
		
	}
}
