<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\VoteTopic;
use App\Models\Visit;
use App\Models\User;
use App\Models\Comment;
use App\Models\VotePost;
use App\Models\VoteComment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardController extends BaseController
{

    /**
     * add visit
     *
     * @return \Illuminate\Http\Response
     */

    public function add_visit(Request $request)
    {

        Visit::create();

        return response()->json(204);
    }

    /**
     * count number visits
     *
     * @return \Illuminate\Http\Response
     */

    public function count_visits($duration)
    {

        if ($duration == 'day') {
            $date = Carbon::now()->format('Y-m-d');
            $count = Visit::where('created_at', 'LIKE', "$date%")->count();

            return $this->sendResponse($count, 'count visitor of the day', 200);
        } elseif ($duration == 'week') {
            $labels = [];
            $data = [];
            $start = Carbon::now()->subWeek()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');
            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = Visit::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];

            return $this->sendResponse($chartData, "count visits during the last week", 200);
        } elseif ($duration == 'month') {
            $labels = [];
            $data = [];
            $start = Carbon::now()->subMonth()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');
            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = Visit::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];

            return $this->sendResponse($chartData, "count visits during the last month", 200);
        } elseif ($duration == 'year') {
            $labels = [];
            $data = [];
            $start = Carbon::now()->subYear()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');
            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = Visit::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];

            return $this->sendResponse($chartData, "count visits during the last year", 200);
        }
    }

    /**
     * count rate conversion
     *
     * @return \Illuminate\Http\Response
     */

    public function conversion()
    {
        $count_users = User::all()->count();
        $count_visitors = Visit::all()->count();
        $conversion = ($count_users / $count_visitors) * 100;

        return $this->sendResponse($conversion, "rate of conversion", 200);
    }

    /**
     * count number inscriptions
     *
     * @return \Illuminate\Http\Response
     */

    public function count_inscriptions($duration)
    {
        if ($duration == 'day') {
            $date = Carbon::now()->format('Y-m-d');
            $count = User::where('created_at', 'LIKE', "$date%")->count();

            return $this->sendResponse($count, 'count visitor of the day', 200);
        } elseif ($duration == 'week') {
            $labels = [];
            $data = [];
            $start = Carbon::now()->subWeek()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');
            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = User::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];

            return $this->sendResponse($chartData, "count visits during the last week", 200);
        } elseif ($duration == 'month') {
            $labels = [];
            $data = [];
            $start = Carbon::now()->subMonth()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');
            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = User::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];

            return $this->sendResponse($chartData, "count visits during the last month", 200);
        } elseif ($duration == 'year') {
            $labels = [];
            $data = [];
            $start = Carbon::now()->subYear()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');
            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = User::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];

            return $this->sendResponse($chartData, "count visits during the last year", 200);
        }
    }

    /**
     * count number comments
     *
     * @return \Illuminate\Http\Response
     */

    public function count_comments($duration)
    {
        if ($duration == 'day') {
            $date = Carbon::now()->format('Y-m-d');
            $count = Comment::where('created_at', 'LIKE', "$date%")->count();

            return $this->sendResponse($count, 'count visitor of the day', 200);
        } elseif ($duration == 'week') {
            $labels = [];
            $data = [];
            $start = Carbon::now()->subWeek()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');
            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = Comment::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];

            return $this->sendResponse($chartData, "count visits during the last week", 200);
        } elseif ($duration == 'month') {
            $labels = [];
            $data = [];
            $start = Carbon::now()->subMonth()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');
            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = Comment::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];

            return $this->sendResponse($chartData, "count visits during the last month", 200);
        } elseif ($duration == 'year') {
            $labels = [];
            $data = [];
            $start = Carbon::now()->subYear()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');
            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = Comment::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];

            return $this->sendResponse($chartData, "count visits during the last year", 200);
        }
    }

    /**
     * count number of games most popular base on number of votes
     *
     * @return \Illuminate\Http\Response
     */

    public function count_games_popularity($number)
    {
        if (is_numeric($number)) {

            $count_votes = VotePost::groupBy('game_id')->select('game_id', VotePost::raw('count(*) as count'))->orderBy('count', 'desc')->take($number)->get();

            $sum_votes = VotePost::groupBy('game_id')->select('game_id', VotePost::raw('sum(vote) as sum'))->orderBy('sum', 'desc')->take($number)->get();

            $data = ['count' => $count_votes, 'sum' => $sum_votes];

            return $this->sendResponse($data, 'count and sum of games votes', 200);
        } elseif ($number == 'all') {

            $labels = [];
            $data = [];
            $start = Carbon::now()->subMonth()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');

            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = VotePost::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];


            return $this->sendResponse($chartData, "count vote topic during the last month", 200);
        } elseif (is_array($number)) {
            $count_votes = VotePost::where('game_id', '=', "" + $number['id'])->count();

            return $this->sendResponse($count_votes, "count numbers of vote for " + $number['id'], 200);
        }
    }

    /**
     * count number of comments most popular base on number of votes
     *
     * @return \Illuminate\Http\Response
     */

    public function count_comments_popularity($number)
    {
        if (is_numeric($number)) {

            $count_votes = VoteComment::groupBy('comment_id')->select('comment_id', VoteComment::raw('count(*) as count'))->orderBy('count', 'desc')->take($number)->get();

            $sum_votes = VoteComment::groupBy('comment_id')->select('comment_id', VoteComment::raw('sum(vote) as sum'))->orderBy('sum', 'desc')->take($number)->get();

            $data = ['count' => $count_votes, 'sum' => $sum_votes];

            return $this->sendResponse($data, 'count and sum of games votes', 200);
        } elseif ($number == 'all') {

            $labels = [];
            $data = [];
            $start = Carbon::now()->subMonth()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');

            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = VoteComment::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];


            return $this->sendResponse($chartData, "count vote topic during the last month", 200);
        } elseif (is_array($number)) {
            $count_vote = VoteComment::where('comment_id', '=', "" + $number['id'])->count();

            return $this->sendResponse($count_vote, "count numbers of vote for " + $number['id'], 200);
        }
    }

    /**
     * count number vote on topics
     *
     * @return \Illuminate\Http\Response
     */

    public function count_topics_popularity($number)
    {
        if (is_numeric($number)) {

            $count_votes = VoteTopic::groupBy('topic_id')->select('topic_id', VoteTopic::raw('count(*) as count'))->orderBy('count', 'desc')->take($number)->get();

            $sum_votes = VoteTopic::groupBy('topic_id')->select('topic_id', VoteTopic::raw('sum(vote) as sum'))->orderBy('sum', 'desc')->take($number)->get();

            $data = ['count' => $count_votes, 'sum' => $sum_votes];

            return $this->sendResponse($data, 'count and sum of games votes', 200);
        } elseif ($number == 'all') {

            $labels = [];
            $data = [];
            $start = Carbon::now()->subMonth()->format('Y-m-d H:m:s');
            $end = Carbon::now()->format('Y-m-d H:m:s');

            $period = CarbonPeriod::create($start, '1 day', $end);
            foreach ($period as $date) {
                $date_format = $date->format('Y-m-d');
                $count_vote = VoteTopic::where('created_at', 'LIKE', "$date_format%")->count();
                array_push($data, $count_vote);
                array_push($labels, $date->format('D'));
            }

            $chartData = ['labels' => $labels, 'data' => $data];


            return $this->sendResponse($chartData, "count vote topic during the last month", 200);
        } elseif (is_array($number)) {
            $count_vote = VoteTopic::where('title', '=', "" + $number['id'])->count();

            return $this->sendResponse($count_vote, "count numbers of vote for " + $number['id'], 200);
        }
    }
}
