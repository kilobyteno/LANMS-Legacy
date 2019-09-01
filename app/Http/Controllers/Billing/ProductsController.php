<?php

namespace LANMS\Http\Controllers\Billing;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = \Stripe::products()->all(array('limit' => 100));
        return view('billing.products.index')->withProducts($products['data']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = \Stripe::products()->find($id);
        /** GET EVENTS FOR PRODUCT AND SKUS - START **/
        $ids = array_column($product['skus']['data'], 'id');
        array_push($ids, $id);
        $events = [];
        foreach ($ids as $id) {
            $id_events = \Stripe::events()->all(['object_id' => $id]);
            foreach ($id_events['data'] as $id_event) {
                array_push($events, $id_event);
            }
        }
        $created = array_column($events, 'created'); # FIND CREATED COLUMN VALUES
        array_multisort($created, SORT_DESC, $events); # SORT ARRAY ON CREATED COLUMN
        /** GET EVENTS FOR PRODUCT AND SKUS - END**/
        abort_unless($product, 404);
        return view('billing.products.show')->withProduct($product)->withEvents($events);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = \Stripe::products()->find($id);
        abort_unless($product, 404);
        return view('billing.products.edit')->withProduct($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
