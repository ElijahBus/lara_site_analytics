<?php

namespace App\Http\View\Composers\Dashboard;

use Illuminate\View\View;
use Dashboard\Facades\Model;

class UsersComposer
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
            ];
    }
}
