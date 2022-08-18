<?php

namespace App\Http\Controllers;

use App\Models\xapp1s1product;
use Illuminate\Http\Request;

class Xapp1s1productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $oItems = xapp1s1product::all()->sortBy('id')->values()->all();
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
        $rec = new xapp1s1product($request->input());
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
     * @param \App\Models\xapp1s1product $xapp1s1product
     * @return \Illuminate\Http\Response
     */
    public function show(xapp1s1product $xapp1s1product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\xapp1s1product $xapp1s1product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, xapp1s1product $xapp1s1product)
    {
        //
        $aRet = [];
        if ($xapp1s1product) {

            if ($xapp1s1product->update($request->toArray())) {
                $aRet = array_merge([
                    'success' => true,
                ], ['data' => $xapp1s1product]
                );
            } else {
                $aRet = ['error' => $xapp1s1product->all()];
            }
        }
        return response()->json($aRet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\xapp1s1product $xapp1s1product
     * @return \Illuminate\Http\Response
     */
    public function destroy(xapp1s1product $xapp1s1product)
    {
        //
        if ($xapp1s1product->delete()) {

            $aRet = array_merge([
                'messages' => $xapp1s1product->id,
                'success' => true,
            ], ['data' => $xapp1s1product]);
        } else {
            $aRet = ['error' => trans('data.destroyfailed', ['data' => $xapp1s1product->id])];
        }
        return response()->json($aRet);
    }

    public function uploadProductFiles(Request $request, xapp1s1product $xapp1s1product)
    {
        $retArr = [];
        $collectionname = "productimgs";
        if ($xapp1s1product) {
            foreach ($request->files->all() as $item) {
                $sOName = str_replace(['#', '/', '\\', ' '], '-', $item->getClientOriginalName());

                $xapp1s1product->getMedia($collectionname)
                    ->each(function ($fileAdder) use ($sOName) {
                        if ($fileAdder->file_name == $sOName) {
                            $fileAdder->delete();
                        }
                    });

                // 单文件时文件名有效
                $retArr = ['name' => $sOName];

                $xapp1s1product
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

    public function delProductFiles(Request $request, xapp1s1product $xapp1s1product)
    {
        $retArr = [];
        $collectionname = "productimgs";

        if ($xapp1s1product) {
            foreach ($request->input("filenames") as $item) {
                $sOName = str_replace(['#', '/', '\\', ' '], '-', $item["name"]);

                $xapp1s1product->getMedia($collectionname)
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

    public function getProductFiles(Request $request, xapp1s1product $xapp1s1product)
    {
        $media = [];
        $retArr = [];
        $collectionname = "productimgs";

        if ($xapp1s1product) {
            $xapp1s1product->getMedia($collectionname)
                ->each(function ($fileAdder) use (&$media) {
                    $media[] = ['name' => $fileAdder->file_name, 'url' => $fileAdder->getFullUrl()];
                });
            // 单文件时文件名有效
            $retArr = ['media' => $media];
        }
        return response()->json($retArr);
    }

}
