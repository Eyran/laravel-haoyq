<?php
/**
 * PdfController.php
 * DOMPDF
 * Author: haoyq
 * Date: 2018/12/22
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\App;
use PDF;

class PdfController extends Controller
{
    /**
     * 展示 PDF
     * @return mixed
     */
    public function printPdf()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');// 根据 HTML 代码生成 PDF
        return $pdf->stream();
    }

    /**
     * 下载 PDF
     * @return mixed
     */
    public function downloadPdf()
    {
        $pdf = PDF::loadView('pdf', ['date' => date('Y-m-d')]);// 根据视图文件生成 PDF
        return $pdf->download('date.pdf');// 参数为文件名
    }

    /**
     * 加载文件，展示 PDF
     * @return mixed
     */
    public function loadFilePdf()
    {
        $file = storage_path('app/public/pdf/name.html');
        if (!is_file($file)) {
            return '没有当前文件';
        }
        $pdf = PDF::loadFile($file);
        return $pdf->stream();
    }

    /**
     * 链式调用
     * @return mixed
     */
    public function chainMethods()
    {
        return PDF::loadView('pdf', ['date' => date('Y-m-d')])->save(storage_path('app/public/pdf/date.pdf'))->stream('date.pdf');
    }
}