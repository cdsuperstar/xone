<?php

namespace App\Http\Controllers;

use App\Models\z_userprofile;
use Illuminate\Http\Request;

class ZUserprofileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = z_userprofile::with('user')->get();
        return response()->json([
            'success'=>true,
            'data'=>$res,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $oItem=z_userprofile::where(["id" => $request->user()->id])->first();
        if($oItem){
            if($oItem->hasMedia('userAvatars')){
                $oItem->avatar=$oItem->getMedia('userAvatars')[0]->getFullUrl();
            }
        }

        return response()->json(['success'=>true,'data'=>$oItem]);
    }

    public function updateMyProfile(Request $request)
    {
        $oItem=z_userprofile::where(["id" => $request->user()->id])->first();
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
            return response()->json(['error' => 'Save failed']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  z_userprofile  $z_userprofile
     * @return \Illuminate\Http\Response
     */
    public function show(z_userprofile $z_userprofile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  z_userprofile  $z_userprofile
     * @return \Illuminate\Http\Response
     */
    public function edit(z_userprofile $z_userprofile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  z_userprofile  $z_userprofile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, z_userprofile $z_userprofile)
    {
        //
        if ($z_userprofile) {
            if ($z_userprofile->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => 'UpdateSucess',
                        'success' => true,
                    ], ['data'=>$z_userprofile]
                    )
                );
            } else {
                return response()->json(['error' => $z_userprofile->name." update failed"]);
            }
        }
        return response()->json(['error' => 'ProfileNotFound']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  z_userprofile  $z_userprofile
     * @return \Illuminate\Http\Response
     */
    public function destroy(z_userprofile $z_userprofile)
    {
        //
    }
}
