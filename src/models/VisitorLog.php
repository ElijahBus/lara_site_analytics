<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    protected $guarded = [];

    # CUSTOM ATTRIBUTES

    public function getTimeSpentAttribute()
    {
        return Carbon::parse($this->visit_started_at)->diffInMilliseconds(Carbon::parse($this->visit_ended_at));
    }

    # RELATIONSHIPS

    /**
     * Define the relationship between a visit logged and
     * the visitor profile
     */
    public function visitorProfile()
    {
        return $this->belongsTo(VisitorProfile::class, 'visitor_id');
    }
}
