<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dashboard\Http\Controllers\Controller;

class TrackingController extends Controller
{
    /**
     * Save the page views analytics
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function trackPageView(Request $request)
    {
        $clientDevice = (int) $request->device;
        $device = '';

        if ($clientDevice >= 1200) {$device = 'desktop';}
        else if ($clientDevice < 450 ) {$device = 'mobile';}
        else {$device = 'ipad';}

        $visit = DB::table('visitor_profiles')->where('token', $request->cookie('rwb_a'))->first();
        if ($visit != null)
            $visit->update([
                'device' => $device
            ]);

        DB::table('page_analytics')->insert([
            'visitor_token' => $request->cookie('rwb_a'),
            'page_name' => $request['page_name'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'page tracked'
        ]);
    }

    /**
     * Save the feature | hits analytics
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function trackFeatureVisit(Request $request)
    {
        DB::table('feature_analytics')->insert([
            'visitor_token' =>$request->cookie('rwb_a'),
            'feature_name' => $request['feature_name'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'feature tracked'
        ]);
    }
}
