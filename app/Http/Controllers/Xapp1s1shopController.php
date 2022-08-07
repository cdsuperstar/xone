<?php

namespace App\Http\Controllers;

use App\Models\xapp1s1shop;
use Illuminate\Http\Request;

class Xapp1s1shopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $oItems = xapp1s1shop::all()->sortBy('id')->values()->all();
        $aRet = ["success" => true, "data" => $oItems];
        return response()->json($aRet);

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
        $rec = new xapp1s1shop($request->input());
        $aRet = [];
        if ($rec->save()) {
            $aRet = array_merge([
                'messages' => $rec->id,
                'success' => true
            ], ['data' => $rec]
            );
        } else {
            $aRet = ['error' => 'NotCreated'];
        }
        return response()->json($aRet);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\xapp1s1shop  $xapp1s1shop
     * @return \Illuminate\Http\Response
     */
    public function show(xapp1s1shop $xapp1s1shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\xapp1s1shop  $xapp1s1shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, xapp1s1shop $xapp1s1shop)
    {
        //
        $aRet = [];
        if ($xapp1s1shop) {

            if ($xapp1s1shop->update($request->toArray())) {
                $aRet = array_merge([
                    'success' => true,
                ], ['data' => $xapp1s1shop]
                );
            } else {
                $aRet = ['error' => $xapp1s1shop->errors()->all()];
            }
        }
        return response()->json($aRet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\xapp1s1shop  $xapp1s1shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(xapp1s1shop $xapp1s1shop)
    {
        //
        $aRet = [];
        if ($xapp1s1shop->delete()) {

            $aRet = array_merge([
                'messages' => $xapp1s1shop->id,
                'success' => true,
            ], ['data' => $xapp1s1shop]);
        } else {
            $aRet = ['error' => trans('data.destroyfailed', ['data' => $xapp1s1shop->id])];
        }
        return response()->json($aRet);
    }
}
