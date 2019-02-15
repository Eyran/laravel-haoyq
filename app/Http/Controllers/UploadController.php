<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * 上传图片到临时目录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadPic(Request $request)
    {
        $request->file('file')->store('temp');

        return response()->json('success');
    }
}
