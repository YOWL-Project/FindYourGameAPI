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

        $array = [];
        $start = Carbon::now()->subMonth()->format('Y-m-d H:m:s');
        $end = Carbon::now()->format('Y-m-d H:m:s');

        $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                array_push($array, $date);
            }

        // for ($index=$start; $index->ad)

        // $test = VoteTopic::where('created_at', '=', $date)->count();



        return $this->sendResponse($array,"ok",200);

    }
}

// data() {
//     return {
//       chartData: {
//         labels: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su', 'Mo', 'Tu', 'We'],
//         datasets: [
//           {
//             label: 'Line Chart',
//             data: [5600, 4150, 5420, 4050, 6522, 7241, 5259, 6157, 7545, 7841],
//             fill: false,
//             borderColor: '#2554FF',
//             backgroundColor: '#2554FF',
//             borderWidth: 1,
//           },
//         ],
//       },
