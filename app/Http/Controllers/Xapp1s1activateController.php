<?php

namespace App\Http\Controllers;

use App\Models\xapp1s1activate;
use Illuminate\Http\Request;

class Xapp1s1activateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $oItems = xapp1s1activate::all()->sortBy('id')->values()->all();
        $aRet = ["success" => true, "data" => $oItems];
        return response()->json($aRet);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rec = new xapp1s1activate($request->input());
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
     * @param \App\Models\xapp1s1activate $xapp1s1activate
     * @return \Illuminate\Http\Response
     */
    public function show(xapp1s1activate $xapp1s1activate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\xapp1s1activate $xapp1s1activate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, xapp1s1activate $xapp1s1activate)
    {
        //
        $aRet = [];
        if ($xapp1s1activate) {
            if ($xapp1s1activate->update($request->toArray())) {
                $aRet = array_merge([
                    'success' => true,
                ], ['data' => $xapp1s1activate]
                );
            } else {
                $aRet = ['error' => $xapp1s1activate->all()];
            }
        }
        return response()->json($aRet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\xapp1s1activate $xapp1s1activate
     * @return \Illuminate\Http\Response
     */
    public function destroy(xapp1s1activate $xapp1s1activate)
    {
        //
        if ($xapp1s1activate->delete()) {

            $aRet = array_merge([
                'messages' => $xapp1s1activate->id,
                'success' => true,
            ], ['data' => $xapp1s1activate]);
        } else {
            $aRet = ['error' => trans('data.destroyfailed', ['data' => $xapp1s1activate->id])];
        }
        return response()->json($aRet);
    }

    public function saveMyActivate(Request $request)
    {
        $rec = new xapp1s1activate($request->input());
        $aRet = [];
        $rec->xapp1s1shop_id = $request->user()->id;
        if ($rec->save()) {
            if (is_array($request->input("slots"))) {
                $rec->slots()->saveMany($request->input("slots"));
            }

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

    public function updateMyActivate(Request $request, xapp1s1activate $xapp1s1activate)
    {
        $aRet = [];
        if ($xapp1s1activate->xapp1s1shop_id == $request->user()->id) {
            if ($xapp1s1activate->update($request->toArray())) {
                $aRet = array_merge([
                    'success' => true,
                ], ['data' => $xapp1s1activate]
                );
            } else {
                $aRet = ['error' => 'Update failed'];
            }
        } else {
            $aRet = ['error' => 'Update failed, activate not found'];
        }
        return response()->json($aRet);
    }

    public function delMyActivate(Request $request, xapp1s1activate $xapp1s1activate)
    {
        if ($xapp1s1activate->xapp1s1shop_id == $request->user()->id) {
            if ($xapp1s1activate->delete()) {
                $aRet = array_merge([
                    'messages' => $xapp1s1activate->id,
                    'success' => true,
                ], ['data' => $xapp1s1activate]);
            } else {
                $aRet = ['error' => trans('data.destroyfailed', ['data' => $xapp1s1activate->id])];
            }
        } else {
            $aRet = ['error' => 'Update failed, activate not found'];
        }
        return response()->json($aRet);
    }
}
