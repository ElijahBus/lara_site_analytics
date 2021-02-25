<?php

namespace App\Http\View\Composers\Dashboard;

use Illuminate\View\View;
use Dashboard\Facades\Model;

class HomeComposer
{


    public function compose(View $view)
    {
        $view->with([
            'homeAnalytics' => $this->homeAnalytics()
        ]);
    }

    /**
     * Find the values of analytics to pass the to the view
     *
     * @return array|mixed
     */
    private function homeAnalytics()
    {
        return
            [
                "authVisitorsInfo" => DashboardAnalytics::authVisitorsInfo(),
                "totalUsersAccounts" => DashboardAnalytics::getTotalUsersAccount(),
                "mobileAppVisitors" => DashboardAnalytics::getMobileAppVisitors(),
                "webVisitors" => DashboardAnalytics::getWebVisitors(),
                "dailyLoggedInUsers" => DashboardAnalytics::getDailyLoggedInUsers(),
                "weeklyLoggedInUsers"  => DashboardAnalytics::getWeeklyLoggedInUsers(),
                "weeklyAuthUsers" => DashboardAnalytics::getWeeklyAuthUsers(),
                "weeklyNonAuthUsers" => DashboardAnalytics::getWeeklyNonAuthUsers(),
                "monthlyLoggedInUsers" => DashboardAnalytics::getMonthlyLoggedInUsers(),
                "monthlyAuthUsers" => DashboardAnalytics::getMonthlyAuthUsers(),
                "monthlyNonAuthUsers" => DashboardAnalytics::getMonthlyNonAuthUsers(),
                "weeklyActiveUsers" => DashboardAnalytics::getWeeklyActiveUsers(),
                "monthlyActiveUsers" => DashboardAnalytics::getMonthlyActiveUsers(),
                "threeMonthsActiveUsers" => DashboardAnalytics::getThreeMonthsActiveUsers(),
                "sixMonthsActiveUsers" => DashboardAnalytics::getSixMonthsActiveUsers(),
                "yearlyActiveUsers" => DashboardAnalytics::getYearlyActiveUsers(),
                "newUsersRetention" => DashboardAnalytics::getNewUsersRetention(),
                "returningUsersRetention" => DashboardAnalytics::getReturningUsersRetention(),
                "mostActiveUsers" => DashboardAnalytics::getMostActiveUsers(10),
                "authUsersTimeSpent" => DashboardAnalytics::getAuthUsersTimeSpent(),
                "nonAuthUsersTimeSpent" => DashboardAnalytics::getNonAuthUsersTimeSpent(),
                "desktopBrowserVisitors" => DashboardAnalytics::getDesktopWebVisitors(),
                "mobileBrowserVisitors" => DashboardAnalytics::getMobileWebVisitors(),
            ];
    }
}
