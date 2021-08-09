<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\VoteTopic;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardController extends BaseController
{
    public function count_vote_topic() {

        $labels = [];
        $data = [];
        $start = Carbon::now()->subMonth()->format('Y-m-d H:m:s');
        $end = Carbon::now()->format('Y-m-d H:m:s');

        $period = CarbonPeriod::create($start, '1 day', $end);
        foreach ($period as $date) {
            $date_format = $date->format('Y-m-d');
            $count_vote = VoteTopic::where('created_at','LIKE', "$date_format%")->count();
            array_push($data, $count_vote);
            array_push($labels, $date->format('D'));
        }

        $chartData = ['labels' => $labels, 'data' => $data];


        return $this->sendResponse($chartData,"ok",200);

    }
}