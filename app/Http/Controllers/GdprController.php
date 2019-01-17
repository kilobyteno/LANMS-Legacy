<?php

namespace LANMS\Http\Controllers;

use LANMS\User;
use Illuminate\Routing\Controller;
//use Illuminate\Support\Facades\Auth;
use Dialect\Gdpr\Http\Requests\GdprDownload;

class GdprController extends Controller
{
    /**
     * Download the GDPR compliant data portability JSON file.
     *
     * @param  \Dialect\Package\Gdpr\Http\Requests\GdprDownload  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function download(GdprDownload $request)
    {
        $credentials = [
            'login'         => \Sentinel::getUser()->username,
            'password'      => $request->input('password'),
        ];

        abort_unless(\Sentinel::authenticate($credentials), 403);

        return response()->json(
            $request->user()->portable(),
            200,
            [
                'Content-Disposition' => 'attachment; filename="user.json"',
            ]
        );
    }

    /**
     * Shows The GDPR terms to the user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTerms()
    {
        \Theme::set('vobilet');
        return view('account.gdpr.message');
    }

    /**
     * Saves the users acceptance of terms and the time of acceptance.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function termsAccepted()
    {
        $user = \Sentinel::getUser();

        \Sentinel::update($user, [
            'accepted_gdpr' => true,
        ]);

        return redirect()->route('dashboard')->with('messagetype', 'success')->with('message', trans('user.gdpr.message.alert.saved'));
    }

    /**
     * Saves the users denial of terms and the time of denial.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function termsDenied()
    {
        $user = \Sentinel::getUser();

        \Sentinel::update($user, [
            'accepted_gdpr' => false,
        ]);
        \Sentinel::logout();
        return redirect()->to('/')->with('messagetype', 'danger')->with('message', trans('user.gdpr.message.alert.denied'));
    }

    /**
     * Anonymizes the user and sets the boolean.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function anonymize($id)
    {
        $user = User::findOrFail($id);

        $user->anonymize();

        \Sentinel::update($user, [
            'isAnonymized' => true,
        ]);

        return redirect()->back();
    }
}
