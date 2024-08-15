<?php

namespace Dashboard\Http\Middlewares;

use Closure;
use App\User;
use Carbon\Carbon;
use App\VisitorLog;
use App\VisitorProfile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use hisorange\BrowserDetect\Parser as Browser;
use DeviceDetector\Parser\Client\Browser as ClientBrowser;
class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $requestCookie = $request->cookie("rwb_a") ?? null;
        $loggedVisitorProfile = VisitorProfile::where('token', $requestCookie)->first();
        $loggedVisit = ($loggedVisitorProfile != null) ? VisitorLog::where('visitor_id', $loggedVisitorProfile->id)->orderBy('id', 'desc')->first() : null;

        // Change visitor status from non-auth to auth
        if ($requestCookie != null && Auth::user()) {
            $this->updateVisitorStatus( $requestCookie);
        }

        // Log a returning visitor for a new daily session
        if (isset($loggedVisit) && ! $loggedVisit->created_at->isToday()) {
            $loggedVisitorProfile->update([
                'last_visit_started_at' => Carbon::now(),
                'last_visit_ended_at' => Carbon::now(),
                'visits_count' => (int) $loggedVisitorProfile->visits_count + 1
            ]);

            $this->logReturningVisit($loggedVisitorProfile->id);

            return $response;
        }

        // Update the visitor visit_ended_at time as long as they are making new request
        if ($requestCookie != null && $loggedVisitorProfile != null) {
            $loggedVisitorProfile->update([
                'last_visit_ended_at' => Carbon::now()
            ]);

            $this->updateVisit($loggedVisitorProfile->id);

            return $response;
        }

        // In case of a new visitor, create a new cookie then log the visit
        $cookieValue = Hash::make(Str::random(20));
        $this->logVisit($request, $cookieValue);

        return $response->withCookie(cookie()->forever('rwb_a', $cookieValue));
    }

    /**
     * Log the incoming visit to the site into the database
     *
     * @param  Request  $request
     * @param $cookie
     * @param  int|null  $returningVisitorId
     *
     * @return string $cookieValue The value of the new cookie set for the user
     */
    private function logVisit(Request $request, $cookie, int $returningVisitorId = null)
    {
        // Create a new visitor profile in case the visitor is not yet logged
        $visitorProfile = VisitorProfile::where('token', $cookie)->first();

        if (! isset($visitorProfile))
            return $this->createNewVisitorProfile($request, $cookie);
        else
            return $this->logReturningVisit($returningVisitorId);
    }

    /**
     * Log the profile of the new visitor who comes to the site
     *
     * @param Request $request
     * @param string $cookie
     * @return VisitorsProfile the new created visitor
     */
    private function createNewVisitorProfile($request, $cookie)
    {
        // Get the visitor id if they are authenticated
        $userId = Auth::user()->id ?? null;

        // Visitor device
        $device = '';
        if (Browser::isMobile()) $device = 'mobile';
        else if (Browser::isTablet()) $device = 'tablet';
        else if (Browser::isDesktop()) $device = 'desktop';

        // Create a new profile
        $newVisitorProfile = VisitorProfile::create([
            'user_id' => $userId,
            'token' => $cookie,
            'ip' => $request->ip(),
            'device' => $device,
            'last_visit_started_at' => Carbon::now(),
            'last_visit_ended_at' => Carbon::now(),
            'visits_count' => 1
        ]);

        // Log the first visit for the created profile
        return $this->logFirstVisit($newVisitorProfile);
    }

    private function logFirstVisit($newVisitorProfile)
    {
        VisitorLog::create([
            'visitor_id' =>  $newVisitorProfile->id,
            'visit_started_at' => Carbon::now(),
            'visit_ended_at' => Carbon::now(),
            'is_returning' => false,
        ]);
    }

    /**
     * Log the returning visit of an existing visitor
     *
     * @param int $returningVisitorId
     * @return VisitorLog the created log of the returning visit
     */
    private function logReturningVisit($returningVisitorId)
    {
        return VisitorLog::create([
            'visitor_id' =>  $returningVisitorId,
            'is_returning' => true,
            'visit_started_at' => Carbon::now(),
            'visit_ended_at' => Carbon::now(),
        ]);
    }

    /**
     * Update the auth log visit in the logs table
     *
     * @param int $visitorId
     * @return void
     */
    private function updateVisit(int $visitorId)
    {
        // Get the visitor's today's log
        $visit = VisitorLog::where('visitor_id', $visitorId)->orderBy('id', 'desc')->first();
        if ($visit == null) return;

        return $visit->update([
            'visit_ended_at' => Carbon::now(),
        ]);
    }

    /**
     * Keep the visitor session alive as long as there are hits and page views
     *
     * @param $token
     *
     * @return void
     */
    private function updateVisitorStatus($token): void
    {
        $visitor = VisitorProfile::where('token', $token)->first();
        if($visitor != null) {
            $visitor->update([
                'is_auth' => true,
                'user_id' => Auth::user()->id,
            ]);
        }
    }
}
