<?php
/**
 * QrController.php
 * Simple Qrcode 二维码
 * Author: haoyq
 * Date: 2018/12/14
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    /**
     * 展示二维码
     * @return mixed
     */
    public function printQr()
    {
//        return QrCode::generate(date('Y-m-d H:i:s'));
        // 设置尺寸
        return QrCode::size(200)->generate(date('Y-m-d H:i:s'));
    }


    /**
     * 保存二维码图片
     */
    public function saveQr()
    {
        $qr = new BaconQrCodeGenerator();

        $path = $this->getSavePath();
//        $qr->generate('hello world', $path.'qr1.svg');
        $qr->format('png')->generate('hello world', $path . 'qr2.png');
    }

    /**
     * 获取保存路径
     * 使用 php artisan storage:link 生成软连接
     * 可以使用 asset(storage/images/qr/xxx) 获取访问地址
     * 详细查看 https://laravelacademy.org/post/9529.html
     * @return string
     */
    private function getSavePath()
    {
        $dir = storage_path('app/public/images/qr/');
        if (!is_dir($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        return $dir;
    }
}