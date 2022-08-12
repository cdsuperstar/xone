<?php

namespace App\Http\Controllers;

use App\Models\xapp1s1profile;
use Illuminate\Http\Request;


class Xapp1s1profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = xapp1s1profile::with('user')->get();
        return response()->json([
            'success'=>true,
            'data'=>$res,
        ]);
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

    public function getMyProfile(Request $request)
    {
        $oItem=xapp1s1profile::where(["id" => $request->user()->id])->first();
        if($oItem){
            if($oItem->hasMedia('userAvatar')){
                $oItem->avatar=$oItem->getMedia('userAvatar')[0]->getFullUrl();
            }
            return response()->json(['success'=>true,'data'=>$oItem]);
        }else{
            return response()->json(['error' => "Null profile."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\xapp1s1profile  $xapp1s1profile
     * @return \Illuminate\Http\Response
     */
    public function show(xapp1s1profile $xapp1s1profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\xapp1s1profile  $xapp1s1profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, xapp1s1profile $xapp1s1profile)
    {
        //
        if ($xapp1s1profile) {
            if ($xapp1s1profile->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => 'UpdateSucess',
                        'success' => true,
                    ], ['data'=>$xapp1s1profile]
                    )
                );
            } else {
                return response()->json(['error' => $xapp1s1profile->name." update failed"]);
            }
        }
        return response()->json(['error' => 'ProfileNotFound']);
    }

    public function updateMyProfile(Request $request)
    {
        $oItem=xapp1s1profile::where(["id" => $request->user()->id])->first();
        if($oItem==null){
            $oItem=new xapp1s1profile(["id" => $request->user()->id]);
        }
        $oItem->id=$request->user()->id;
        $oItem->fill($request->input());


        if($oItem->save()){
            if (is_array($request->input('files'))) {
                $aFiles = $request->input('files');
                $request->user()
                    ->getMedia('userTmpFiles')
                    ->each(function ($fileAdder) use ($aFiles, $oItem) {
                        foreach ($aFiles as $aFile) {
                            if ($fileAdder->file_name == $aFile) {
                                $fileAdder->move($oItem, 'userAvatars');
                            }
                        }
                    });
                $oItem->avatar=$oItem->getMedia('userAvatars')[0]->getFullUrl();
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\xapp1s1profile  $xapp1s1profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(xapp1s1profile $xapp1s1profile)
    {
        //
    }
}
