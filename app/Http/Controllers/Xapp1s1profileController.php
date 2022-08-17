<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'success' => true,
            'data' => $res,
        ]);
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
    }

    public function getMyProfile(Request $request)
    {
        $oItem = xapp1s1profile::where(["user_id" => $request->user()->id])->first();
        if ($oItem) {
            if ($oItem->hasMedia('userAvatar')) {
                $oItem->avatar = $oItem->getMedia('userAvatar')[0]->getFullUrl();
            }
            return response()->json(['success' => true, 'data' => $oItem]);
        } else {
            return response()->json(['error' => "Null profile."]);
        }
    }

    public function getTheUserProfile(User $user)
    {
        $aRet = [];
        if ($user->xapp1s1profile_pub) {
            $aUrls = [];
            $user->xapp1s1profile_pub->getMedia('userAvatar')
                ->each(function ($fileAdder) use (&$aUrls) {
                    $aUrls[] = $fileAdder->getFullUrl();
                });
            $user->xapp1s1profile_pub->userAvatar = $aUrls;
            $aRet = ["success" => true, "data" => $user->xapp1s1profile_pub];
        } else {
            $aRet = ["error" => "Profile not found"];
        }

        return response()->json($aRet);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\xapp1s1profile $xapp1s1profile
     * @return \Illuminate\Http\Response
     */
    public function show(xapp1s1profile $xapp1s1profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\xapp1s1profile $xapp1s1profile
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
                    ], ['data' => $xapp1s1profile]
                    )
                );
            } else {
                return response()->json(['error' => $xapp1s1profile->name . " update failed"]);
            }
        }
        return response()->json(['error' => 'ProfileNotFound']);
    }

    public function updateMyAvatar(Request $request)
    {
        $oItem = xapp1s1profile::where(["user_id" => $request->user()->id])->first();
        if ($oItem == null) {
            $oItem = new xapp1s1profile(["user_id" => $request->user()->id]);
            $oItem->save();
        }

        if (count($request->input('filenames')) > 0) {
            $aFiles = $request->input('filenames');
            $request->user()
                ->getMedia('userTmpFiles')
                ->each(function ($fileAdder) use ($aFiles, $oItem) {
                    foreach ($aFiles as $aFile) {
                        if ($fileAdder->file_name == $aFile["name"]) {
                            $oItem->clearMediaCollection('userAvatar');
                            $fileAdder->move($oItem, 'userAvatar');
                        }else{
                            $fileAdder->delete();
                        }
                    }
                });

            return response()->json(array_merge([
                    'messages' => 'Avatar saved，ID:' . $oItem->id,
                    'success' => true,
                ], ['data' => $oItem]
                )
            );

        } else {
            return response()->json(['error' => "Avatar save failed."]);
        }

    }

    public function updateMyProfile(Request $request)
    {
        $oItem = xapp1s1profile::where(["user_id" => $request->user()->id])->first();
        if ($oItem == null) {
            $oItem = new xapp1s1profile(["user_id" => $request->user()->id]);
        }
        $oItem->user_id = $request->user()->id;
        $oItem->fill($request->input());


        if ($oItem->save()) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\xapp1s1profile $xapp1s1profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(xapp1s1profile $xapp1s1profile)
    {
        //
    }
}
