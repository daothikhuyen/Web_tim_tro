<?php

namespace App\Http\Controllers;

use App\Http\Service\UploadService;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{

    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function uploadFile(Request $request){
        // dd($request->file);
        $request->validate([
            'file' => 'required|mimes:png,jpg,mp4'
        ]);

        $url = $this->uploadService->store($request);

        if($url != false){
            return response()->json([
                'message' => 'Tải File thành công',
                'url' => $url
            ]);
        }else{
            return response()->json([
                'message' => 'Tải File thất bại',
            ]);
        }

    }
}
