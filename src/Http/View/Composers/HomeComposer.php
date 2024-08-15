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
                "authVisitorsInfo" => AnalyticsInterface::authVisitorsInfo(),
                "totalUsersAccounts" => AnalyticsInterface::getTotalUsersAccount(),
                "mobileAppVisitors" => AnalyticsInterface::getMobileAppVisitors(),
                "webVisitors" => AnalyticsInterface::getWebVisitors(),
                "dailyLoggedInUsers" => AnalyticsInterface::getDailyLoggedInUsers(),
                "weeklyLoggedInUsers"  => AnalyticsInterface::getWeeklyLoggedInUsers(),
                "weeklyAuthUsers" => AnalyticsInterface::getWeeklyAuthUsers(),
                "weeklyNonAuthUsers" => AnalyticsInterface::getWeeklyNonAuthUsers(),
                "monthlyLoggedInUsers" => AnalyticsInterface::getMonthlyLoggedInUsers(),
                "monthlyAuthUsers" => AnalyticsInterface::getMonthlyAuthUsers(),
                "monthlyNonAuthUsers" => AnalyticsInterface::getMonthlyNonAuthUsers(),
                "weeklyActiveUsers" => AnalyticsInterface::getWeeklyActiveUsers(),
                "monthlyActiveUsers" => AnalyticsInterface::getMonthlyActiveUsers(),
                "threeMonthsActiveUsers" => AnalyticsInterface::getThreeMonthsActiveUsers(),
                "sixMonthsActiveUsers" => AnalyticsInterface::getSixMonthsActiveUsers(),
                "yearlyActiveUsers" => AnalyticsInterface::getYearlyActiveUsers(),
                "newUsersRetention" => AnalyticsInterface::getNewUsersRetention(),
                "returningUsersRetention" => AnalyticsInterface::getReturningUsersRetention(),
                "mostActiveUsers" => AnalyticsInterface::getMostActiveUsers(10),
                "authUsersTimeSpent" => AnalyticsInterface::getAuthUsersTimeSpent(),
                "nonAuthUsersTimeSpent" => AnalyticsInterface::getNonAuthUsersTimeSpent(),
                "desktopBrowserVisitors" => AnalyticsInterface::getDesktopWebVisitors(),
                "mobileBrowserVisitors" => AnalyticsInterface::getMobileWebVisitors(),
            ];
    }
}
