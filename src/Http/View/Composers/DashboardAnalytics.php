<?php

namespace App\Http\View\Composers\Dashboard;

use App\User;
use Carbon\Carbon;
use App\VisitorLog;
use App\VisitorProfile;
use Carbon\CarbonPeriod;
use Dashboard\Facades\Model;
use Illuminate\Support\Facades\DB;
use function App\Helpers\dashboardTimeFormat;

use App\Contracts\DashboardAnalytics as ContractsDashboardAnalytics;

define('ANALYTICS_WEEK_START_DATE', Carbon::today()->subDays(6)->format('Y-m-d'));
define('ANALYTICS_WEEK_END_DATE', Carbon::today()->format('Y-m-d'));
define('ANALYTICS_USER_MODEL', Model::user());

class DashboardAnalytics  implements ContractsDashboardAnalytics
{
    /**
     * Carbon time that help calculate the weekly start date and end date
     *
     * @var Carbon
     */
    private static $weekStartDate = ANALYTICS_WEEK_START_DATE;
    private static  $currentDate = ANALYTICS_WEEK_END_DATE;

    /**
     * The user model
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    private static $user = ANALYTICS_USER_MODEL;

    private static function fetchAuthVisitors()
    {
        return VisitorProfile::with('user')->whereIsAuth(true);
    }

    /**
     * Return the authenticated visitors with their public info.
     * The user information is accessed via the @relation user on VisitorProfile.
     *
     * @return void
     */
    public static function authVisitorsInfo()
    {
        return self::fetchAuthVisitors()->get();
    }

    /**
     * Get the tolal registered murugo users
     *
     * @return mixed
     */
    public static function getTotalUsersAccount()
    {
        return self::$user::all()->count();
    }

    /**
     * Get the nunmber of users that logged-in the site in a day
     *
     * @return integer
     */
    public static function getDailyLoggedInUsers()
    {
        // WARNING: Return placeholder value to replace by the real data
        return 300;
    }

    /**
     * Get the number of users that logged-in the site in a week
     *
     * @return integer
     */
    public static function getWeeklyLoggedInUsers()
    {
        // WARNING: Return placeholder value to replace by the real data
        return 432;
    }

    /**
     * Get the number of users that logged-in (visited) the site in a month
     * both auth and non auth users
     *
     * @return integer
     */
    public static function getMonthlyLoggedInUsers()
    {
        return self::getMonthlyAuthUsers() + self::getMonthlyNonAuthUsers();
    }

    /**
     * Get the number of users that visited the , last 90 days
     *
     * @return integer
     */
    public static function getWebVisitors()
    {
        $daysStartDate = Carbon::tomorrow()->subDays(90)->format('Y-m-d');
        $daysEndDate = Carbon::tomorrow()->format('Y-m-d');

        $visitors = DB::table('visitor_logs')
            ->whereBetween('visitor_logs.created_at',  [$daysStartDate, $daysEndDate])
            ->get()
            ->groupBy('visitor_id')
            ->count();


        return $visitors;
    }

    /**
     * Get the number of users who visitred the site from desktop browsers
     *
     * @return integer
     */
    public static function getDesktopWebVisitors()
    {
        return DB::table('visitor_profiles')->where('device', 'desktop')->count();
    }

    /**
     * Get the numbet of users who visited the site from mobie browsers
     *
     * @return void
     */
    public static function getMobileWebVisitors()
    {
        return DB::table('visitor_profiles')->where('device', 'mobile')->count();
    }

    /**
     * Get the number of users who used the mobile app
     *
     * @return integer
     */
    public static function getMobileAppVisitors()
    {
        // WARNING: Return placeholder value to replace by real data
        return 0;
    }

    /**
     * Get the numbers of authenticated users who visited the site in a week
     *
     * @return array
     */
    public static function getWeeklyAuthUsers()
    {
        $authUsersCounts = [];
        $dates = [];
        $period = CarbonPeriod::create(self::$weekStartDate, self::$currentDate);

        foreach ($period as $date) {
            $dateFormatted = explode(',', $date->toFormattedDateString())[0];
            array_push($dates, $dateFormatted);

            $dailyAuthUsers = DB::table('visitor_logs')
                ->join('visitor_profiles', 'visitor_logs.visitor_id', '=', 'visitor_profiles.id')
                ->where('visitor_profiles.is_auth', true)
                ->whereDate('visitor_logs.created_at', '=', $date->format('Y-m-d'))
                ->select('visitor_logs.created_at')
                ->count();

            array_push($authUsersCounts, $dailyAuthUsers);
        }

        return [$dates, $authUsersCounts];
    }

    /**
     * Get the numbers of non-authenticated users who visited the site in a week
     *
     * @return array
     */
    public static function getWeeklyNonAuthUsers()
    {
        $nonAuthUsersCounts = [];
        $dates = [];
        $period = CarbonPeriod::create(self::$weekStartDate, self::$currentDate);

        foreach ($period as $date) {
            $dateFormatted = explode(',', $date->toFormattedDateString())[0];
            array_push($dates, $dateFormatted);

            $dailyNonAuthUsers = DB::table('visitor_logs')
                ->join( 'visitor_profiles', 'visitor_logs.visitor_id', '=', 'visitor_profiles.id')
                ->where('visitor_profiles.is_auth', false)
                ->whereDate('visitor_logs.created_at', '=', $date->format('Y-m-d'))
                ->select('visitor_logs.created_at')
                ->count();

            array_push($nonAuthUsersCounts, $dailyNonAuthUsers);
        }

        return [$dates, $nonAuthUsersCounts];
    }

    /**
     * Get the number of authenticated users who visited the site in a month,
     * counting from the current day
     *
     * @return integer
     */
    public static function getMonthlyAuthUsers()
    {
        $monthStartDate = Carbon::tomorrow()->subMonth()->format('Y-m-d');
        $monthEndDate = Carbon::tomorrow()->format('Y-m-d');

        $monthlyAuthVisitors = DB::table('visitor_logs')
            ->join('visitor_profiles', 'visitor_logs.visitor_id', '=', 'visitor_profiles.id')
            ->where('visitor_profiles.is_auth', true)
            ->whereBetween('visitor_logs.created_at',  [$monthStartDate, $monthEndDate])
            ->get()
            ->groupBy('visitor_id')
            ->count();


        return $monthlyAuthVisitors;
    }

    /**
     * Get the number of non-authenticated users who visited the site in a month,
     * couting from the current day
     *
     * @return integer
     */
    public static function getMonthlyNonAuthUsers()
    {
        $monthStartDate = Carbon::tomorrow()->subMonth()->format('Y-m-d');
        $monthEndDate = Carbon::tomorrow()->format('Y-m-d');

        $monthlyNonAuthVisitors = DB::table('visitor_logs')
            ->join('visitor_profiles', 'visitor_logs.visitor_id', '=', 'visitor_profiles.id')
            ->where('visitor_profiles.is_auth', false)
            ->whereBetween('visitor_logs.created_at',  [$monthStartDate, $monthEndDate])
            ->get()
            ->groupBy('visitor_id')
            ->count();


        return $monthlyNonAuthVisitors;
    }

    /**
     * Get the number of active users withing 7 days from the current date
     *
     * @return array
     */
    public static function getWeeklyActiveUsers()
    {
        $allActiveUsers = self::getActiveUsers(6, 7);
        $authActiveUsers = self::getAuthActiveUsers(6);

        return [
            'all' => $allActiveUsers,
            'auth' => $authActiveUsers,
        ];
    }

    /**
     * Get the number of active users withing a month from the current date
     *
     * @return array
     */
    public static function getMonthlyActiveUsers()
    {
        $oneLineData = self::getActiveUsers(27, 28);
        $detailedData = self::getActiveUsers(27, 7);

        $allActiveUsers = ['oneLineData' => $oneLineData, 'detailedData' => $detailedData];
        $authActiveUsers = self::getAuthActiveUsers(28);

        return [
            'all' => $allActiveUsers,
            'auth' => $authActiveUsers
        ];
    }

    /**
     * Get the number of active user within 3 months from the current date
     *
     * @return array
     */
    public static function getThreeMonthsActiveUsers()
    {
        $activeUsers = self::getActiveUsers(83, 28);

        $oneLineData = self::computeActiveUsers($activeUsers, 28);
        $detailedData = self::computeActiveUsers($activeUsers, 4);

        $allActiveUsers = ['oneLineData' => $oneLineData, 'detailedData' => $detailedData];
        $authActiveUsersChunk = self::getAuthActiveUsers(83, 28);

        $dates = [];
        $authActiveUsers = [];
        foreach ($authActiveUsersChunk[1] as $users) {
            foreach ($users as $group) {
                $usersGroup = array_sum($group);
                array_push($authActiveUsers, $usersGroup);
            }
        }

        foreach ($authActiveUsersChunk[0] as $group) {
            $dateRange = $group[0] . "-" . end($group);
            array_push($dates, $dateRange);
        }

        return [
            'all' => $allActiveUsers,
            'auth' => [$dates, array_chunk($authActiveUsers, 3)]
        ];
    }

    /**
     * Get the number of active users within six month from the current date
     *
     * @return array
     */
    public static function getSixMonthsActiveUsers()
    {
        $activeUsers = self::getActiveUsers(167, 28);

        $oneLineData = self::computeActiveUsers($activeUsers, 28);
        $detailedData = self::computeActiveUsers($activeUsers, 4);

        $allActiveUsers = ['oneLineData' => $oneLineData, 'detailedData' => $detailedData];
        $authActiveUsersChunk = self::getAuthActiveUsers(167, 28);

        $dates = [];
        $authActiveUsers = [];
        foreach ($authActiveUsersChunk[1] as $users) {
            foreach ($users as $group) {
                $usersGroup = array_sum($group);
                array_push($authActiveUsers, $usersGroup);
            }
        }

        foreach ($authActiveUsersChunk[0] as $group) {
            $dateRange = $group[0] . "-" . end($group);
            array_push($dates, $dateRange);
        }

        return [
            'all' => $allActiveUsers,
            'auth' => [$dates, array_chunk($authActiveUsers, 6)]
        ];
    }

    /**
     * Get the number of active users within a year from the current date
     *
     * @return array
     */
    public static function getYearlyActiveUsers()
    {
        $activeUsers = self::getActiveUsers(335, 28);

        $oneLineData = self::computeActiveUsers($activeUsers, 28, 12);
        $detailedData = self::computeActiveUsers($activeUsers, 4);

        $allActiveUsers = ['oneLineData' => $oneLineData, 'detailedData' => $detailedData];
        $authActiveUsersChunk = self::getAuthActiveUsers(335, 28);

        $dates = [];
        $authActiveUsers = [];
        foreach ($authActiveUsersChunk[1] as $users) {
            foreach ($users as $group) {
                $usersGroup = array_sum($group);
                array_push($authActiveUsers, $usersGroup);
            }
        }

        foreach ($authActiveUsersChunk[0] as $group) {
            $dateRange =  end($group);
            array_push($dates, $dateRange);
        }

        return [
            'all' => $allActiveUsers,
            'auth' => [$dates, array_chunk($authActiveUsers, 12)]
        ];
    }

    /**
     * Fetch active users from the database within a period of time,
     * The data is then grouped  according to the need. (weeks, months, etc..)
     * Note that a month is considered as 28 days.
     *
     * @param integer $daysSpan, The range of days to select from.
     * @param integer $group, The grouping number.
     * @return array of dates and active users.
     */
    private static function getActiveUsers($daysSpan, $group = 0)
    {
        $usersCounts = [];
        $dates = [];
        $startDate = Carbon::parse(self::$currentDate)->subDays($daysSpan)->format('Y-m-d');
        $period = CarbonPeriod::create($startDate, self::$currentDate);

        foreach ($period as $date) {
            $dateFormatted = explode(',', $date->toFormattedDateString())[0];
            array_push($dates, $dateFormatted);

            $activeUsers = DB::table('visitor_logs')
            ->select('created_at')
            ->whereDate('created_at', '=', $date->format('Y-m-d'))
                ->groupBy('visitor_id')
                ->get();

            array_push($usersCounts, $activeUsers->count());
        }

        return ($group != 0)
            ? [array_chunk($dates, $group), array_chunk($usersCounts, $group)]
            : [$dates, $usersCounts];
    }

    private static function getAuthActiveUsers($daysSpan, $group = 0)
    {
        $authUsersCounts = [];
        $nonAuthUsersCounts = [];
        $dates = [];
        $startDate = Carbon::parse(self::$currentDate)->subDays($daysSpan)->format('Y-m-d');
        $period = CarbonPeriod::create($startDate, self::$currentDate);

        foreach ($period as $date) {
            $dateFormatted = explode(',', $date->toFormattedDateString())[0];
            array_push($dates, $dateFormatted);

            $authActiveUsers = DB::table('visitor_logs')
                ->join('visitor_profiles', 'visitor_logs.visitor_id', '=', 'visitor_profiles.id')
                ->select('visitor_logs.created_at')
                ->whereDate('visitor_logs.created_at', '=', $date->format('Y-m-d'))
                ->where('visitor_profiles.is_auth', true)
                ->groupBy('visitor_logs.visitor_id')
                ->get();

            array_push($authUsersCounts, $authActiveUsers->count());

            $nonAuthActiveUsers = DB::table('visitor_logs')
                ->join('visitor_profiles', 'visitor_logs.visitor_id', '=', 'visitor_profiles.id')
                ->select('visitor_logs.created_at')
                ->whereDate('visitor_logs.created_at', '=', $date->format('Y-m-d'))
                ->where('visitor_profiles.is_auth', false)
                ->groupBy('visitor_logs.visitor_id')
                ->get();

            array_push($nonAuthUsersCounts, $nonAuthActiveUsers->count());
        }

        return ($group != 0)
            ? [
                array_chunk($dates, $group),
                [
                    array_chunk($authUsersCounts, $group),
                    array_chunk($nonAuthUsersCounts, $group)
                ]
            ]
            : [$dates, $authUsersCounts, $nonAuthUsersCounts];
    }

    /**
     * Get the number of active users fetched from the db
     * Then, group them into ranges of dates
     *
     * @param array $activeUsers
     * @return array the grouped data
     * @depends segmentActiveUsers()
     */
    private static function computeActiveUsers($activeUsers, $segmentLength, $lastChunkLength = 7)
    {
        $datesRange = self::segmentActiveUsers($activeUsers[0], 'end', $segmentLength, $lastChunkLength);
        $usersCounts = self::segmentActiveUsers($activeUsers[1], 'array_sum', $segmentLength, $lastChunkLength);

        return [$datesRange, $usersCounts];
    }

    private static function segmentActiveUsers(array $activeUsers, $aggregate, int $segmentLength, int $lastChunkLength)
    {
        $segments = [];

        foreach ($activeUsers as $key => $data) {
            // Group all data into monthly segment of 28 days
            $dataGroups =  array_chunk($data, 28);
            foreach ($dataGroups as $group) {

                // Group each month's data into segments
                $dataGroups = array_chunk($group, $segmentLength);
                foreach ($dataGroups as $group) {

                    // Get, and push the last date of each group as the display date
                    $value = $aggregate($group);
                    array_push($segments, $value);
                }
            }
        }

        // Segment the last result to display
        $segments = array_chunk($segments, $lastChunkLength);

        return $segments;
    }


    /**
     * Get the number of new users visiting the site, or users with a new cookie set,
     * in weekly segement
     *
     * @return array
     */
    public static function getNewUsersRetention()
    {
        $newUsersCount = [];
        $dates = [];

        $period = CarbonPeriod::create(self::$weekStartDate, self::$currentDate);

        foreach ($period as $date) {
            array_push($dates, explode(',', $date->toFormattedDateString())[0]);

            $usersCounts = DB::table('visitor_profiles')
                ->select('created_at')
                ->where('is_auth', true)
                ->whereDate('created_at', '=', $date->format('Y-m-d'))
                ->count();

            array_push($newUsersCount, $usersCounts);

        }

        return [$dates, $newUsersCount];
    }

    /**
     * Get the number of returing users to the site, in weekly segment
     *
     * @return array
     */
    public static function getReturningUsersRetention()
    {
        $returningUsersCount = [];
        $dates = [];

        $period = CarbonPeriod::create(self::$weekStartDate, self::$currentDate);

        foreach ($period as $date) {
            array_push($dates, explode(',', $date->toFormattedDateString())[0]);

            $usersCounts = DB::table('visitor_logs')
                ->join('visitor_profiles', 'visitor_logs.visitor_id', '=', 'visitor_profiles.id')
                ->whereDate('visitor_logs.created_at', '=', $date->format('Y-m-d'))
                ->where('visitor_profiles.is_auth', true)
                ->where('visitor_logs.is_returning', '=', true)
                ->select('visitor_logs.created_at')
                ->count();


            array_push($returningUsersCount, $usersCounts);
        }

        return [$dates, $returningUsersCount];
    }

    /**
     * Get the 10 mot active users
     *
     * @return mixed
     */
    public static function getMostActiveUsers($limit)
    {
        return VisitorProfile::with('user')
            ->whereIsAuth(true)
            ->orderBy('visits_count', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Get the time authenticated users spent on the site in a month
     *
     * @return mixed
     */
    public static function getAuthUsersTimeSpent()
    {
        $timeSpent = 0;
        $loggedVisitors = VisitorProfile::with('visitorLog')->where('is_auth', true)->get();

        foreach ($loggedVisitors as $visitor) {
            foreach ($visitor->visitorLog as $visit) {
                if ($visit->created_at->isToday())
                    $timeSpent += $visit->time_spent;
            }
        }

        // Get  today's averate time spent on site of visitors

        $todaysVisitor = VisitorLog::whereDate('created_at', Carbon::today())->count();

        if ($todaysVisitor == 0) $timeSpent = 0;
        else $timeSpent /= $todaysVisitor;

        return dashboardTimeFormat($timeSpent);
    }

    /**
     * Get the time non authenticated users spent on the site
     *
     * @return mixed
     */
    public static function getNonAuthUsersTimeSpent()
    {
        $timeSpent = 0;
        $loggedVisitors = VisitorProfile::with('visitorLog')->where('is_auth', false)->get();

        foreach ($loggedVisitors as $visitor) {
            foreach ($visitor->visitorLog as $visit) {
                if ($visit->created_at->isToday())
                    $timeSpent += $visit->time_spent;
            }
        }

        // Get  today's averate time spent on site of visitors

        $todaysVisitor = VisitorLog::whereDate('created_at', Carbon::today())->count();

        if ($todaysVisitor == 0) $timeSpent = 0;
        else $timeSpent /= $todaysVisitor;

        return dashboardTimeFormat($timeSpent);
    }

    public static function __callStatic($name, $arguments)
    {
        $class = get_called_class();
        return new $class();
    }
}
