<?php

namespace App\Http\Controllers;

use App\Models\xapp1s1product;
use App\Models\xapp1s1activate;
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
        $oItem = xapp1s1shop::with(['products'])->where(["user_id" => $request->user()->id])->get();
        if (count($oItem) > 0) {
            $aRet = ['success' => true, 'data' => $oItem];
        } else {
            $aRet = ['error' => "Null profile."];
        }
        return response()->json($aRet);

    }

    public function getTheShop(Request $request, xapp1s1shop $xapp1s1shop)
    {
        $aRet = [];
        $oItem = xapp1s1shop::with(['products'])->where(["id" => $xapp1s1shop->id])->get();
        if ($oItem) {
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
        $tmpShop =
            $request->user()
                ->xapp1s1shop;
        if ($request->files->count() && $tmpShop) {
            foreach ($request->files->all() as $item) {
                $sOName = str_replace(['#', '/', '\\', ' '], '-', $item->getClientOriginalName());

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

    public function delMyShopFiles(Request $request, string $collectionname)
    {
        $retArr = [];
        $tmpShop =
            $request->user()
                ->xapp1s1shop;

        if (count($request->input("filenames")) > 0 && $tmpShop) {
            foreach ($request->input("filenames") as $item) {
                $sOName = str_replace(['#', '/', '\\', ' '], '-', $item["name"]);

                $tmpShop->getMedia($collectionname)
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

    public function getMyShopFiles(Request $request, string $collectionname)
    {
        $media = [];
        $retArr = [];
        $tmpShop =
            $request->user()
                ->xapp1s1shop;

        if ($tmpShop) {
            $tmpShop->getMedia($collectionname)
                ->each(function ($fileAdder) use (&$media) {
                    $media[] = ['name' => $fileAdder->file_name, 'url' => $fileAdder->getFullUrl()];
                });
            // 单文件时文件名有效
            $retArr = ['media' => $media];
        }
        return response()->json($retArr);
    }

    public function saveMyShopProduct(Request $request, xapp1s1shop $xapp1s1shop)
    {
        $aRet = [];
        if ($xapp1s1shop && count($request->input("product")) > 0) {
            $oTmpProduct = new xapp1s1product($request->input("product"));
            $xapp1s1shop->products()->save($oTmpProduct);
            $oItem = xapp1s1shop::with(['products'])->where(["user_id" => $request->user()->id, "id" => $xapp1s1shop->id])->get();
            $aRet = ['success' => true, 'data' => $oItem];
        } else {
            $aRet = ['error' => "Null shop or null product."];

        }
        return response()->json($aRet);
    }

    public function delMyShopProduct(Request $request, xapp1s1product $xapp1s1product)
    {
        $aRet = [];
        $oItem = $request->user()->xapp1s1shop->products()->find($xapp1s1product->id);
        if ($oItem->delete()) {

            $aRet = array_merge([
                'messages' => $oItem->id,
                'success' => true,
            ], ['data' => $oItem]);
        } else {
            $aRet = ['error' => trans('data.destroyfailed', ['data' => $oItem->id])];
        }
        return response()->json($aRet);
    }

    public function getMyactivates(Request $request)
    {
        $aRet = [];
        if ($request->user()->xapp1s1shop) {
//            $oItem = xapp1s1shop::with('activates.slots')->where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();
            $oItem = xapp1s1activate::with(['slots', 'shop'])->where('xapp1s1shop_id', $request->user()->xapp1s1shop->id)->orderBy('id', 'desc')->get();
        }
        if ($oItem) {
            $aRet = array_merge([
                'messages' => count($oItem),
                'success' => true,
            ], ['data' => $oItem]);
        } else {
            $aRet = ['error' => null];
        }

        return response()->json($aRet);
    }

    public function getMyShopProducts(Request $request, xapp1s1shop $xapp1s1shop)
    {
        $aRet = [];
        $oItems = xapp1s1shop::with('products')->where([['user_id', $request->user()->id], ['id', $xapp1s1shop->id]])->orderBy('id', 'desc')->get();

        if ($oItems) {
            $aRet = array_merge([
                'messages' => count($oItems),
                'success' => true,
            ], ['data' => $oItems]);
        } else {
            $aRet = ['error' => null];
        }

        return response()->json($aRet);
    }
}
