<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class NewBiddingCycle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bidding:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new bidding cycle';

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
        Log::info('new bidding cycle running');

        $rst = DB::table('bidding_config')->first();

        //only run when current date-time is tuesday 8am
        if (date('D') != $rst->start_day || date('H') != $rst->start_hour)
            return;

        $latestBiddingCycle = DB::table('bidding_cycles')
            ->orderBy('id', 'desc')
            ->first();

        if (!$latestBiddingCycle) {
            $this->insertBiddingCycle($rst->bidding_hours);
            return;
        } elseif ($latestBiddingCycle->is_open == 0) { // only create new bidding cycle when the latest cycle is closed
            $this->insertBiddingCycle($rst->bidding_hours);
            return;
        }
        return;
    }

    private function insertBiddingCycle($biddingHours)
    {
        $endDate = date_create(date('Y-m-d H:00:00'));
        date_add($endDate, date_interval_create_from_date_string("$biddingHours hours"));
        DB::table('bidding_cycles')->insert([
            "created_at" => date('Y-m-d H:i:s'),
            "start_date" => date('Y-m-d H:00:00'),
            "end_date" => $endDate,
            "is_open" => 1
        ]);

    }
}
