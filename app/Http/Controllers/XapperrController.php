<?php

namespace App\Http\Controllers;

use App\Models\xapperr;
use Illuminate\Http\Request;

class XapperrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $oItems = xapperr::query()->orderByDesc('id')->get();
        $aRet = ["success" => true, "data" => $oItems];
        return response()->json($aRet);
    }

    public function clearLogs()
    {
        //
        xapperr::query()->delete();
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
        $rec = new xapperr($request->input());
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
     * @param  \App\Models\xapperr  $xapperr
     * @return \Illuminate\Http\Response
     */
    public function show(xapperr $xapperr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\xapperr  $xapperr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, xapperr $xapperr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\xapperr  $xapperr
     * @return \Illuminate\Http\Response
     */
    public function destroy(xapperr $xapperr)
    {
        //
    }
}
