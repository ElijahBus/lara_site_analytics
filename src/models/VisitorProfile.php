<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dashboard\Facades\Model as DashboardModelFacade;

class VisitorProfile extends Model
{
    protected $guarded = [];

    # RELATIONSHIPS

    public function visitorLog()
    {
        return $this->hasMany(VisitorLog::class, 'visitor_id', 'id');
    }

    /**
     * Define the relationship between an authenticated visitor
     * and his model at the parent application level
     */
    public function user()
    {
        return $this->belongsTo(DashboardModelFacade::user(), 'user_id');
    }


}
