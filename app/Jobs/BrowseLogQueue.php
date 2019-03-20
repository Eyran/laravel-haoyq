<?php
/**
 * 浏览记录入库
 */

namespace App\Jobs;

use App\Events\NotifyAdmin;
use App\Models\BrowseLog;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Exception;

class BrowseLogQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // 最大失败次数
    public $tries = 5;

    // 超时
    public $timeout = 120;

    protected $ip_addr;
    protected $request_url;
    protected $city_name;
    protected $created_at;
    protected $updated_at;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ip_addr, $request_url, $city_name, $now)
    {
        $this->ip_addr = $ip_addr;
        $this->request_url = $request_url;
        $this->city_name = $city_name;
        $this->created_at = $now;
        $this->updated_at = $now;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(BrowseLog $browseLog)
    {
        $log = new $browseLog;

        $log->ip_addr = $this->ip_addr;
        $log->request_url = $this->request_url;
        $log->city_name = $this->city_name;
        $log->created_at = $this->created_at;
        $log->updated_at = $this->updated_at;

        $log->save();
    }

    /**
     * 任务失败
     * @param Exception $exception
     */
    public function failed(Exception $exception)
    {
        // 发送邮件，通知管理员
        event(new NotifyAdmin($exception->getMessage()));
    }
}
