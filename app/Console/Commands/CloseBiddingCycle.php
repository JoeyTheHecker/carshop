<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CloseBiddingCycle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bidding:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close current bidding cycle';

     /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Singapore');
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('close bidding cycle running');

        $currentDate = date('Y-m-d H:i:s');

        DB::table('bidding_cycles')
        ->where('is_open', 1)
        ->where('end_date', '<=', $currentDate)
        ->orderBy('id', 'desc')
        ->limit(1)
        ->update(['is_open' => 0]);
    }
}
