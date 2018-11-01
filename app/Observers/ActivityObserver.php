<?php

namespace LANMS\Observers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Spatie\Activitylog\Models\Activity;

class ActivityObserver
{
    public function creating(Activity $activity) {
        $user = Sentinel::getUser();

        if (isset($user)) {
            $activity->causer_id = $user->id;
            $activity->causer_type = get_class($user);
        }
    }
}