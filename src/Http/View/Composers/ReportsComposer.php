<?php

namespace App\Http\View\Composers\Dashboard;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ReportsComposer
{
    public function compose(View $view)
    {
        $view->with([
            'pageViews' => $this->getReports()['pageViews'],
            'featuresVisits' => $this->getReports()['featuresVisits']
        ]);
    }

    public function getReports()
    {
        $pageViews = DB::table('page_analytics')
        ->select('page_name', DB::raw('count(page_name) as page_views_count'))
        ->groupBy('page_name')
        ->get();

        $featuresVisits = DB::table('feature_analytics')
        ->select('feature_name', DB::raw('count(feature_name) as feature_visits_count'))
        ->groupBy('feature_name')
        ->get();

        return [
            'pageViews' => $pageViews,
            'featuresVisits' => $featuresVisits
        ];
    }
}
