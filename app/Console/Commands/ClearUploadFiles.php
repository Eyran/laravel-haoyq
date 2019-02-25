<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearUploadFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clearUploadFiles:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '删除上传后未处理的无用文件';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $time = time();
        $disk = Storage::disk('public');
        $files = $disk->allFiles('temp/');

        if (!$files) {
            return;
        }

        foreach ($files as $key => $value) {
            // 超过两天
            if ($time - $disk->lastModified($value) > 172800) {
                $disk->delete($value);
            }
        }
    }
}
