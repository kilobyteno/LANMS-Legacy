<?php

namespace LANMS\Http\Controllers\API;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

use LANMS\Http\Resources\User as UserResource;
use LANMS\Http\Resources\UserCollection;
use LANMS\User;

class v2Controller extends Controller
{
    public function userCheckin()
    {
        return new UserResource(User::find(1));
    }


    public function userCheckinAll()
    {
        return new UserCollection(User::all());
    }
}
