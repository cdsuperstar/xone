<?php

namespace App\Http\Controllers;

use App\Models\xapp1s1moment;
use Illuminate\Http\Request;

class Xapp1s1momentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $oItems = xapp1s1moment::all()->sortBy('id')->values()->all();
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
        $rec = new xapp1s1moment($request->input());
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
     * @param  \App\Models\xapp1s1moment  $xapp1s1moment
     * @return \Illuminate\Http\Response
     */
    public function show(xapp1s1moment $xapp1s1moment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\xapp1s1moment  $xapp1s1moment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, xapp1s1moment $xapp1s1moment)
    {
        //
        $aRet = [];
        if ($xapp1s1moment) {
            \Log::info('Update test',[$xapp1s1moment]);
            if ($xapp1s1moment->update($request->toArray())) {
                $aRet = array_merge([
                    'success' => true,
                ], ['data' => $xapp1s1moment]
                );
            } else {
                $aRet = ['error' => $xapp1s1moment->all()];
            }
        }
        return response()->json($aRet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\xapp1s1moment  $xapp1s1moment
     * @return \Illuminate\Http\Response
     */
    public function destroy(xapp1s1moment $xapp1s1moment)
    {
        //
        if ($xapp1s1moment->delete()) {

            $aRet = array_merge([
                'messages' => $xapp1s1moment->id,
                'success' => true,
            ], ['data' => $xapp1s1moment]);
        } else {
            $aRet = ['error' => trans('data.destroyfailed', ['data' => $xapp1s1moment->id])];
        }
        return response()->json($aRet);
    }

    public function postMyMoment(Request $request)
    {
        $oItem=new xapp1s1moment(["id" => $request->user()->id]);
        $oItem->user()->assortment($request->user());
        $oItem->fill($request->input());

        if($oItem->save()){
            if (is_array($request->input('files'))) {
                $aFiles = $request->input('files');
                $request->user()
                    ->getMedia('userTmpFiles')
                    ->each(function ($fileAdder) use ($aFiles, $oItem) {
                        foreach ($aFiles as $aFile) {
                            if ($fileAdder->file_name == $aFile) {
                                $fileAdder->move($oItem, 'pics');
                            }
                        }
                    });
                $oItem->avatar=$oItem->getMedia('pics')[0]->getFullUrl();
            }
            return response()->json(array_merge([
                    'messages' => '保存成功，ID:'.$oItem->id,
                    'success' => true,
                ], ['data'=>$oItem]
                )
            );
        }else{
            return response()->json(['error' => $oItem->errors()->all()]);
        }
    }

    // 关注的动态
    public function getFocusedMoments(){
        $oItems = xapp1s1moment::all()->sortBy('id')->values()->all();
        $aRet = ["success" => true, "data" => $oItems];

        return response()->json($aRet);
    }

    // 推荐的动态
    public function getRecommMoments()
    {
        $oItems = xapp1s1moment::all()->sortBy('id')->values()->all();
        $aRet = ["success" => true, "data" => $oItems];

        return response()->json($aRet);
    }

    // 商铺的动态
    public function getShopMoments()
    {
        $oItems = xapp1s1moment::all()->sortBy('id')->values()->all();
        $aRet = ["success" => true, "data" => $oItems];

        return response()->json($aRet);
    }

    // 自已的动态
    public function getMyPostedMoments(Request $request)
    {
        $oItems = xapp1s1moment::where('user_id',"=",$request->user()->id)->sortBy('id')->values()->all();
        $aRet = ["success" => true, "data" => $oItems];

        return response()->json($aRet);
    }
}
