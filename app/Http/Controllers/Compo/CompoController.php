<?php

namespace LANMS\Http\Controllers\Compo;

use LANMS\Compo;
use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

class CompoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compos = Compo::thisYear()->get();
        return view('compo.index')->with('compos', $compos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \LANMS\Compo  $compo
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $compo = Compo::where('slug', '=', $slug)->first();
        return view('compo.show')->withCompo($compo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \LANMS\Compo  $compo
     * @return \Illuminate\Http\Response
     */
    public function edit(Compo $compo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \LANMS\Compo  $compo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compo $compo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \LANMS\Compo  $compo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compo $compo)
    {
        //
    }
}
