<?php

namespace LANMS\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
    /**
     * Dismiss the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $notifications = Sentinel::getUser()->notifications()->paginate(10);
        return view('account.notifications')->withNotifications($notifications);
    }
    
    /**
     * Dismiss the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dismiss($id)
    {
        $notification = Sentinel::getUser()->unreadNotifications->find($id);
        if ($notification) {
            $notification->markAsRead();
        }
        return Redirect::back();
    }
}
