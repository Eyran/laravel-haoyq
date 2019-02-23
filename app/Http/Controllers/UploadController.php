<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * 上传图片到临时目录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadPic(Request $request)
    {
        // 验证上传是否错误
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            $this->returnErrorByJson();
        }

        // 验证是否为图片
        $ext = $request->file('file')->extension();
        if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $this->returnErrorByJson();
        }

        // 是否保存成功
        $path = $request->file('file')->store('public/temp');
        if (!$path) {
            $this->returnErrorByJson();
        }

        // 返回文件名
        return response()->json(basename($path));
    }

    /**
     * 将文件从临时目录保存到正式目录
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function uploadFormal(Request $request)
    {
        $disk = Storage::disk('public');

        $filePath = 'temp/' . $request->input('file_name');
        $savePath = 'images/uploads/' . $request->input('file_name');

        if (!$disk->exists($filePath)) {
            return back()->with(['message' => '上传失败，请重试！']);
        }

        if (!$disk->move($filePath, $savePath)) {
            return back()->with(['message' => '上传失败，请重试！']);
        }

        return redirect($disk->url($savePath));
    }

    /**
     * 返回 json 格式的错误
     * @param string $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function returnErrorByJson($data = 'error', $status = 403)
    {
        return response()->json($data, $status);
    }
}
