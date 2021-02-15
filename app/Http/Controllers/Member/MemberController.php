<?php

namespace LANMS\Http\Controllers\Member;

use LANMS\User;
use Spatie\Searchable\Search;
use LANMS\Http\Controllers\Controller;
use Spatie\Searchable\ModelSearchAspect;
use LANMS\Http\Requests\Member\SearchRequest;

class MemberController extends Controller
{
    public function profile($username)
    {
        $theuser = User::where('username', '=', $username)->first();
        if ($theuser == null) {
            return abort(404); //if username does not exist
        }
        $onlinestatus = User::getOnlineStatus($theuser->id);
        $userarray = $theuser->toArray();
        $userarray['onlinestatus'] = $onlinestatus;
        return response()->view('members.profile')->with($userarray);
    }

    public function index()
    {
        $members = User::orderBy('username', 'asc')->where('last_activity', '<>', '')->where('isAnonymized', '0')->paginate(20);
        $totalmembers = User::orderBy('username', 'asc')->where('last_activity', '<>', '')->where('isAnonymized', '0')->get();
        $newestmembers = User::orderBy('created_at', 'desc')->where('last_activity', '<>', '')->where('isAnonymized', '0')->take(10)->get();
        $onlinemembers = User::orderBy('last_activity', 'desc')->where('last_activity', '<>', '')->where('isAnonymized', '0')->take(10)->get();
        
        return response()->view('members.index')
                ->with('members', $members)
                ->with('totalmembers', $totalmembers)
                ->with('newestmembers', $newestmembers)
                ->with('onlinemembers', $onlinemembers);
    }

    public function search(SearchRequest $request)
    {
        //$members = \Searchy::users('firstname', 'lastname', 'username')->query($request->search)->getQuery()->having('last_activity', '<>', '')->having('isAnonymized', '0')->get();
        $searchResults = (new Search())
           ->registerModel(User::class, function(ModelSearchAspect $modelSearchAspect){
            $modelSearchAspect
               ->addSearchableAttribute('username')
               ->addSearchableAttribute('firstname')
               ->addSearchableAttribute('lastname')
               ->active();
            })->search($request->search);

        //dd($members);
        $newestmembers = User::orderBy('created_at', 'desc')->where('last_activity', '<>', '')->where('isAnonymized', '0')->take(10)->get();
        $onlinemembers = User::orderBy('last_activity', 'desc')->where('last_activity', '<>', '')->where('isAnonymized', '0')->take(10)->get();
        
        return response()->view('members.search')
                ->with('query', $request->search)
                ->with('searchResults', $searchResults)
                ->with('newestmembers', $newestmembers)
                ->with('onlinemembers', $onlinemembers);
    }
}
