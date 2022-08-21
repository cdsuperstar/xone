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
                $rec->slots()->createMany($request->input("slots"));
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

    public function searchFitActivates(Request $request)
    {
        $aRet = [];
        $aSearchParams = [];
        if (isset($request->input[''])) {
            $aSearchParams = $request->input['searchParams'];
        }

        $oSelfProfile = $request->user()->xapp1s1profile;
        if($oSelfProfile){

/*
    phone: "13333333333",
     companyname: "一个兔子两个大",
     approval: "待审核",
     birthday: "1979-11-09",
     constellation: "天蝎座",
     sex: "1",
     nickname: "aaaa",
     height: 123,
     incomebegin: 3000,
     incomeend: 12000,
     province: "山西省",
     city: "太原市",
     district: "迎泽区",
     addr: "what the fuck? ' or true or '",
     eduback: "硕士",
     marriage: "已婚",
     nationality: "汉族",
     career: "工程师",
     nativeplace: "四川省",
     weight: 123,
     housesitu: "已购房",
     carsitu: "已购车",
     smokesitu: "烟抽得很多",
     drinksitu: "稍微喝一点酒",
     childrensitu: "没有孩子",
 * */
            $aRet = array_merge([
                    'success' => true,
                    'data' => $aSearchParams]
            );
        }else{
            $aRet = ['error' => 'Null user profile.'];
        }

        return response()->json($aRet);
    }
}
