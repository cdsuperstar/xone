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
     * @param \Illuminate\Http\Request $request
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
     * @param \App\Models\xapp1s1shop $xapp1s1shop
     * @return \Illuminate\Http\Response
     */
    public function show(xapp1s1shop $xapp1s1shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\xapp1s1shop $xapp1s1shop
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
                $aRet = ['error' => "Update failed"];
            }
        }
        return response()->json($aRet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\xapp1s1shop $xapp1s1shop
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

    public function getMyShop(Request $request)
    {
        $oItem = xapp1s1shop::where(["id" => $request->user()->id])->first();
        if ($oItem) {
            if ($oItem->hasMedia('shopAvatar')) {
                $oItem->avatar = $oItem->getMedia('shopAvatar')[0]->getFullUrl();
            }
            return response()->json(['success' => true, 'data' => $oItem]);
        } else {
            return response()->json(['error' => "Null profile."]);
        }
    }

    public function updateMyShop(Request $request)
    {
        $oItem = xapp1s1shop::where(["id" => $request->user()->id])->first();
        if ($oItem == null) {
            $oItem = new xapp1s1shop(["id" => $request->user()->id]);
        }
        $oItem->id = $request->user()->id;
        $oItem->fill($request->input());


        if ($oItem->save()) {
            if (is_array($request->input('files'))) {
                $aFiles = $request->input('files');
                $request->user()
                    ->getMedia('userTmpFiles')
                    ->each(function ($fileAdder) use ($aFiles, $oItem) {
                        foreach ($aFiles as $aFile) {
                            if ($fileAdder->file_name == $aFile) {
                                $fileAdder->move($oItem, 'shopAvatar');
                            }
                        }
                    });
                $oItem->avatar = $oItem->getMedia('shopAvatar')[0]->getFullUrl();
            }
            return response()->json(array_merge([
                    'messages' => '保存成功，ID:' . $oItem->id,
                    'success' => true,
                ], ['data' => $oItem]
                )
            );
        } else {
            return response()->json(['error' => "Save failed."]);
        }
    }
}
