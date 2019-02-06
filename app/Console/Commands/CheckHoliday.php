<?php

namespace App\Console\Commands;

use App\Contracts\Holiday;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CheckHoliday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkHoliday:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '检查次日是否为节日';

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
    public function handle(Holiday $holiday)
    {
        $tomorrow = now()->addDay(1)->format('Ymd');

        $flag = $holiday->isHoliday($tomorrow);

        if ($flag) {
            Cache::put('is_holiday:' . $tomorrow, 1, 60 * 25);
        }
    }
}
