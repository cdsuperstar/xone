<?php

namespace App\Http\Controllers;

use App\Models\comment;
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
     * @param \Illuminate\Http\Request $request
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
     * @param \App\Models\xapp1s1moment $xapp1s1moment
     * @return \Illuminate\Http\Response
     */
    public function show(xapp1s1moment $xapp1s1moment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\xapp1s1moment $xapp1s1moment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, xapp1s1moment $xapp1s1moment)
    {
        //
        $aRet = [];
        if ($xapp1s1moment) {
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
     * @param \App\Models\xapp1s1moment $xapp1s1moment
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
        $oItem = new xapp1s1moment();
        $oItem->user_pub()->associate($request->user());
        $oItem->fill($request->input());

        if ($oItem->save()) {
            if (is_array($request->input('pics'))) {
                $aFiles = $request->input('pics');
                $aUrls = [];
                $request->user()
                    ->getMedia('userTmpFiles')
                    ->each(function ($fileAdder) use ($aFiles, $oItem, &$aUrls) {
                        foreach ($aFiles as $aFile) {
                            if ($fileAdder->file_name == $aFile["name"]) {
                                $fileAdder->move($oItem, 'pics');
                                $aUrls[] = $fileAdder->getFullUrl();
                            }
                        }
                    });
//                $oItem->avatar = $oItem->getMedia('pics')[0]->getFullUrl();
            }

            $oItem->pics = $aUrls;

            return response()->json(array_merge([
                    'messages' => '保存成功，ID:' . $oItem->id,
                    'success' => true,
                ], ['data' => $oItem]
                )
            );
        } else {
            return response()->json(['error' => $oItem->all()]);
        }
    }

    // 关注的动态
    public function getFocusedMoments()
    {
        $oItems = xapp1s1moment::with(['user_pub.xapp1s1profile_pub', 'comments.user_pub.xapp1s1profile_pub', 'thumbs.user_pub.xapp1s1profile_pub'])->where('type', '=', '个人')->orderBy('id')->get();
        $oItems->each(function (&$oItem) {
            $aUrls = [];
            $oItem->getMedia('pics')
                ->each(function ($fileAdder) use (&$aUrls) {
                    $aUrls[] = $fileAdder->getFullUrl();
                });
            $oItem->pics = $aUrls;
        });
        $aRet = ["success" => true, "data" => $oItems];

        return response()->json($aRet);
    }

    // 推荐的动态
    public function getRecommMoments()
    {
        $oItems = xapp1s1moment::with('User_pub.xapp1s1profile_pub')->where('type', '=', '个人')->orderBy('id')->get();
        $aRet = ["success" => true, "data" => $oItems];

        return response()->json($aRet);
    }

    // 商铺的动态
    public function getShopMoments()
    {
        $oItems = xapp1s1moment::with('User_pub.xapp1s1profile_pub')->where('type', '=', '商家')->orderBy('id')->get();
        $aRet = ["success" => true, "data" => $oItems];

        return response()->json($aRet);
    }

    // 自已的动态
    public function getMyPostedMoments(Request $request)
    {
        $oItems = xapp1s1moment::with('User_pub.xapp1s1profile_pub')->where('user_id', "=", $request->user()->id)->orderBy('id')->get();
        $aRet = ["success" => true, "data" => $oItems];

        return response()->json($aRet);
    }

    // 更新的动态
    public function updateMyMoment(Request $request, xapp1s1moment $xapp1s1moment)
    {
        $aRet = [];
        if ($xapp1s1moment) {
            if ($request->user()->xapp1s1moments()->find($xapp1s1moment->id)->update($request->toArray())) {
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

    // 删除的动态
    public function delMyMoment(Request $request, xapp1s1moment $xapp1s1moment)
    {
        if ($request->user()->xapp1s1moments()->find($xapp1s1moment->id)->delete()) {

            $aRet = array_merge([
                'messages' => $xapp1s1moment->id,
                'success' => true,
            ], ['data' => $xapp1s1moment]);
        } else {
            $aRet = ['error' => trans('data.destroyfailed', ['data' => $xapp1s1moment->id])];
        }
        return response()->json($aRet);
    }

    // 点赞或者取消点赞
    public function thumbUpMoment(Request $request, xapp1s1moment $xapp1s1moment)
    {
        $aRet = [];
        $tmpContent = 1;
        if ($request->input('content')) {
            $tmpContent = $request->input('content');
        }
        if ($xapp1s1moment->thumbs()->where('user_id', '=', $request->user()->id)->where('content', '=', $tmpContent)->count() > 0) {
            if ($xapp1s1moment->thumbs()->where('user_id', '=', $request->user()->id)->where('content', '=', $tmpContent)->delete()) {
                $aRet = ['success' => true, 'data' => $xapp1s1moment->thumbs()->with(['user_pub.xapp1s1profile_pub'])->get(['id', 'user_id', 'content'])];
            } else {
                $aRet = ['error' => 'Thumb up cancel failed!'];
            }
        } else {
            if ($xapp1s1moment->thumbs()->create(['content' => $tmpContent])->user_pub()->associate($request->user()->id)->save()) {
                $aRet = ['success' => true, 'data' => $xapp1s1moment->thumbs()->with(['user_pub.xapp1s1profile_pub'])->get(['id', 'user_id', 'content'])];
            } else {
                $aRet = ['error' => 'Thumb up failed!'];
            }
        }
        return response()->json($aRet);

    }

    // 评论
    public function commentMoment(Request $request, xapp1s1moment $xapp1s1moment)
    {
        $aRet = [];
        if ($request->input('content')) {
            $tmpContent = $request->input('content');
            if ($xapp1s1moment->comments()->create(['content' => $tmpContent])->user_pub()->associate($request->user()->id)->save()) {
                $aRet = ['success' => true, 'data' => $xapp1s1moment->comments()->get(['id', 'user_id', 'content', 'created_at'])];
            } else {
                $aRet = ['error' => 'Comment create failed!'];
            }
        } else {
            $aRet = ['error' => 'Comment null failed!'];
        }
        return response()->json($aRet);
    }

    // 取消评论
    public function delCommentMoment(Request $request, comment $comment)
    {
        $aRet = [];
        if ($comment->user_pub()->get()[0]->id == $request->user()->id) {

            $aRet = [
                'success' => true,
                'data' => $request->user()->id];
        } else {
            $aRet = ['error' => 'Delete failed'];
        }
        return response()->json($aRet);
    }


}
