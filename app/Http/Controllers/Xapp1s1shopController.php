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
        $aRet = [];
        $oItem = xapp1s1shop::where(["user_id" => $request->user()->id])->first();
        if ($oItem) {
            if ($oItem->hasMedia('shopAvatar')) {
                $oItem->avatar = $oItem->getMedia('shopAvatar')[0]->getFullUrl();
            }
            $aRet = ['success' => true, 'data' => $oItem];
        } else {
            $aRet = ['error' => "Null profile."];
        }
        return response()->json($aRet);

    }

    public function updateMyShop(Request $request)
    {
        $oItem = xapp1s1shop::where(["user_id" => $request->user()->id])->first();
        if ($oItem == null) {
            $oItem = new xapp1s1shop(["user_id" => $request->user()->id]);
        }
        $oItem->user_id = $request->user()->id;
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

    public function uploadMyShopFiles(Request $request, string $collectionname)
    {
        $retArr = [];
        if ($request->files->count()) {
            foreach ($request->files->all() as $item) {
                $sOName = str_replace(['#', '/', '\\', ' '], '-', $item->getClientOriginalName());
                $tmpShop =
                    $request->user()
                        ->xapp1s1shop;
                $tmpShop->getMedia($collectionname)
                    ->each(function ($fileAdder) use ($sOName) {
                        if ($fileAdder->file_name == $sOName) {
                            $fileAdder->delete();
                        }
                    });

                // 单文件时文件名有效
                $retArr = ['name' => $sOName];

                $tmpShop
                    ->addAllMediaFromRequest()
                    ->each(function ($fileAdder) use ($sOName, $collectionname) {
                        $fileAdder
                            ->sanitizingFileName(function ($fileName) {
                                return str_replace(['#', '/', '\\', ' '], '-', $fileName);
                            })
                            ->toMediaCollection($collectionname);
                    });
            }

        }
        return response()->json($retArr);
    }

    public function delMyShopFiles(Request $request, string $collection)
    {
        $retArr = [];
        if (count($request->input("filenames")) > 0) {
            foreach ($request->input("filenames") as $item) {
                $sOName = str_replace(['#', '/', '\\', ' '], '-', $item["name"]);
                $tmpShop =
                    $request->user()
                        ->xapp1s1shop;

                $tmpShop->getMedia($collection)
                    ->each(function ($fileAdder) use ($sOName) {
                        if ($fileAdder->file_name == $sOName) {
                            $fileAdder->delete();
                        }
                    });
                // 单文件时文件名有效
                $retArr = ['success' => true, 'data' => $sOName];
            }

        }
        return response()->json($retArr);
    }

    public function getMyShopFiles(Request $request, string $collection)
    {
        $media = [];
        $tmpShop =
            $request->user()
                ->xapp1s1shop;

        $tmpShop->getMedia($collection)
            ->each(function ($fileAdder) use (&$media) {
                $media[] = ['name' => $fileAdder->file_name, 'url' => $fileAdder->getFullUrl()];
            });
        // 单文件时文件名有效
        $retArr = ['media' => $media];
        return response()->json($retArr);
    }
}
