<?php

namespace App\Http\Controllers;

use App\Models\Pro;
use Illuminate\Http\Request;

class ProController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pro::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'producttitle' => 'required',
            'productdescription' => 'required',
            'productprice' => 'required'
        ]);

        Pro::create($request->all());

        return response('', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pro  $pro
     * @return \Illuminate\Http\Response
     */
    public function show(Pro $pro)
    {
        return $pro;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pro  $pro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pro $pro)
    {
        $request->validate([
            'producttitle' => 'required',
            'productdescription' => 'required',
            'productprice' => 'required'
        ]);

        $pro->update($request->all());

        return response('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pro  $pro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pro $pro)
    {
        $pro->delete();
        return response('', 204);
    }
}
