<?php

namespace App\Http\Controllers;

use App\Models\xapp1s1activate;
use Illuminate\Http\Request;
use App\Models\xapp1s1slot;

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

        $oUser = $request->user();
        if (is_array($request->input('searchParams'))) {
            $aSearchParams = $request->input('searchParams');
        }

        $oSelfProfile = $oUser->xapp1s1profile;
        if ($oSelfProfile) {
            $query = xapp1s1slot::with(['active'])->whereHas('active', function ($query) use ($aSearchParams) {
                if (isset($aSearchParams["nameOrDescription"])) {
                    $query->where([['name', 'like', '%' . $aSearchParams["nameOrDescription"] . '%']])->orWhere([['description', 'like', '%' . $aSearchParams["nameOrDescription"] . '%']]);
                }
            });

            if ($oUser->xapp1s1profile->age) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['agebegin', '<=', $oUser->xapp1s1profile->age], ['ageend', '>=', $oUser->xapp1s1profile->age]])
                        ->orWhere([['agebegin', null], ['ageend', null]])
                        ->orWhere([['agebegin', '<=', $oUser->xapp1s1profile->age], ['ageend', null]])
                        ->orWhere([['agebegin', null], ['ageend', '>=', $oUser->xapp1s1profile->age]]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['agebegin', null], ['ageend', null]]);
                });
            }

            if ($oUser->xapp1s1profile->constellation) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['constellation', 'like', "%" . trim($oUser->xapp1s1profile->constellation) . "%"]])
                        ->orWhere([['constellation', '不限']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['constellation', '不限']]);
                });
            }

            if ($oUser->xapp1s1profile->sex) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['sex', $oUser->xapp1s1profile->sex]])
                        ->orWhere([['sex', '0']])
                        ->orWhere([['sex', null]]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['sex', '0']]);
                });
            }

            if ($oUser->xapp1s1profile->height) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['heightbegin', '<=', $oUser->xapp1s1profile->height], ['heightend', '>=', $oUser->xapp1s1profile->height]])
                        ->orWhere([['heightbegin', null], ['heightend', null]])
                        ->orWhere([['heightbegin', '<=', $oUser->xapp1s1profile->height], ['heightend', null]])
                        ->orWhere([['heightbegin', null], ['heightend', '>=', $oUser->xapp1s1profile->height]]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['heightbegin', null], ['heightend', null]]);
                });
            }

            if ($oUser->xapp1s1profile->incomebegin) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['incomebegin', '<=', $oUser->xapp1s1profile->incomebegin]])
                        ->orWhere([['incomebegin', null]]);
                });
            }

            if ($oUser->xapp1s1profile->incomeend) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['incomeend', '>=', $oUser->xapp1s1profile->incomeend]])
                        ->orWhere([['incomeend', null]]);
                });
            }

            if ($oUser->xapp1s1profile->eduback) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['eduback', 'like', "%" . trim($oUser->xapp1s1profile->eduback) . "%"]])
                        ->orWhere([['eduback', '不限']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['eduback', '不限']]);
                });
            }

            if ($oUser->xapp1s1profile->marriage) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['marriage', 'like', "%" . trim($oUser->xapp1s1profile->marriage) . "%"]])
                        ->orWhere([['marriage', '不限']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['marriage', '不限']]);
                });
            }

            if ($oUser->xapp1s1profile->career) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['career', 'like', "%" . trim($oUser->xapp1s1profile->career) . "%"]])
                        ->orWhere([['career', '不限']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['career', '不限']]);
                });
            }

            if ($oUser->xapp1s1profile->weight) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['weightbegin', '<=', $oUser->xapp1s1profile->weight]])
                        ->orWhere([['weightbegin', null]]);
                });
            }

            if ($oUser->xapp1s1profile->weight) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['weightend', '>=', $oUser->xapp1s1profile->weight]])
                        ->orWhere([['weightend', null]]);
                });
            }

            if ($oUser->xapp1s1profile->housesitu) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['housesitu', 'like', "%" . trim($oUser->xapp1s1profile->housesitu) . "%"]])
                        ->orWhere([['housesitu', '不限']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['housesitu', '不限']]);
                });
            }

            if ($oUser->xapp1s1profile->carsitu) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['carsitu', 'like', "%" . trim($oUser->xapp1s1profile->carsitu) . "%"]])
                        ->orWhere([['carsitu', '不限']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['carsitu', '不限']]);
                });
            }

            if ($oUser->xapp1s1profile->smokesitu) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['smokesitu', 'like', "%" . trim($oUser->xapp1s1profile->smokesitu) . "%"]])
                        ->orWhere([['smokesitu', '不限']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['smokesitu', '不限']]);
                });
            }

            if ($oUser->xapp1s1profile->drinksitu) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['drinksitu', 'like', "%" . trim($oUser->xapp1s1profile->drinksitu) . "%"]])
                        ->orWhere([['drinksitu', '不限']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['drinksitu', '不限']]);
                });
            }

            if ($oUser->xapp1s1profile->childrensitu) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['childrensitu', 'like', "%" . trim($oUser->xapp1s1profile->childrensitu) . "%"]])
                        ->orWhere([['childrensitu', '不限']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['childrensitu', '不限']]);
                });
            }

            $oItems = $query->orderBy('id', 'desc')->get();
            $aRet = array_merge([
                    'success' => true,
                    'data' => $oItems]
            );

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

        } else {
            $aRet = ['error' => 'Null user profile.'];
        }

        return response()->json($aRet);
    }
}
