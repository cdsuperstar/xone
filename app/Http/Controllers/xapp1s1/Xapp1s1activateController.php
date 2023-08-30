<?php

namespace App\Http\Controllers\xapp1s1;

use App\Events\msgEvt;
use App\Models\xapp1s1\xapp1s1activate;
use Illuminate\Http\Request;
use App\Models\xapp1s1\xapp1s1slot;
use Illuminate\Support\Facades\Auth;

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

    public function saveMyActivate(Request $request, xapp1s1activate $xapp1s1activate)
    {
        $blActSuccess = false;
        $aRet = [];
        if ($xapp1s1activate->id) {
            $rec = $xapp1s1activate;
            $blActSuccess = $rec->update($request->toArray());
        } else {
            $rec = new xapp1s1activate($request->input());
            $blActSuccess = $request->user()->xapp1s1shop->activates()->save($rec);
        }

        if ($blActSuccess) {
            if (is_array($request->input("slots"))) {
                $rec->slots()->delete();
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

    public function uploadMyActivateFiles(Request $request, xapp1s1activate $xapp1s1activate)
    {
        $retArr = [];
        if ($request->files->count() && $xapp1s1activate) {
            foreach ($request->files->all() as $item) {
                $sOName = str_replace(['#', '/', '\\', ' '], '-', $item->getClientOriginalName());

                $xapp1s1activate->getMedia("pics")
                    ->each(function ($fileAdder) use ($sOName) {
                        if ($fileAdder->file_name == $sOName) {
                            $fileAdder->delete();
                        }
                    });

                // 单文件时文件名有效
                $retArr = ['name' => $sOName];

                $xapp1s1activate
                    ->addAllMediaFromRequest()
                    ->each(function ($fileAdder) use ($sOName) {
                        $fileAdder
                            ->sanitizingFileName(function ($fileName) {
                                return str_replace(['#', '/', '\\', ' '], '-', $fileName);
                            })
                            ->toMediaCollection("pics");
                    });
            }

        }
        return response()->json($retArr);
    }

    public function delMyActivateFiles(Request $request, xapp1s1activate $xapp1s1activate)
    {
        $retArr = [];
        $collectionname = "pics";

        if (count($request->input("filenames")) > 0 && $xapp1s1activate) {
            foreach ($request->input("filenames") as $item) {
                $sOName = str_replace(['#', '/', '\\', ' '], '-', $item["name"]);

                $xapp1s1activate->getMedia($collectionname)
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

    public function getMyActivateFiles(Request $request, xapp1s1activate $xapp1s1activate)
    {
        $media = [];
        $retArr = [];
        $collectionname = "pics";

        if ($xapp1s1activate) {
            $xapp1s1activate->getMedia($collectionname)
                ->each(function ($fileAdder) use (&$media) {
                    $media[] = ['name' => $fileAdder->file_name, 'url' => $fileAdder->getFullUrl()];
                });
            // 单文件时文件名有效
            $retArr = ['media' => $media];
        }
        return response()->json($retArr);
    }

    public function searchFitActivates(Request $request)
    {
        $aRet = [];
        $aSearchParams = [];

        $oUser = $request->user();
        if (is_array($request->input('searchParams'))) {
            $aSearchParams = $request->input('searchParams');
        }
        broadcast(new msgEvt(Auth::id(), "Server side test(broadcast), content is: " . $aSearchParams["nameOrDescription"]));

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
                        ->orWhere([['constellation', 'like', '%不限%']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['constellation', 'like', '%不限%']]);
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
                        ->orWhere([['eduback', 'like', '%不限%']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['eduback', 'like', '%不限%']]);
                });
            }

            if ($oUser->xapp1s1profile->marriage) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['marriage', 'like', "%" . trim($oUser->xapp1s1profile->marriage) . "%"]])
                        ->orWhere([['marriage', 'like', '%不限%']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['marriage', 'like', '%不限%']]);
                });
            }

            if ($oUser->xapp1s1profile->career) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['career', 'like', "%" . trim($oUser->xapp1s1profile->career) . "%"]])
                        ->orWhere([['career', 'like', '%不限%']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['career', 'like', '%不限%']]);
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
                        ->orWhere([['housesitu', 'like', '%不限%']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['housesitu', 'like', '%不限%']]);
                });
            }

            if ($oUser->xapp1s1profile->carsitu) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['carsitu', 'like', "%" . trim($oUser->xapp1s1profile->carsitu) . "%"]])
                        ->orWhere([['carsitu', 'like', '%不限%']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['carsitu', 'like', '%不限%']]);
                });
            }

            if ($oUser->xapp1s1profile->smokesitu) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['smokesitu', 'like', "%" . trim($oUser->xapp1s1profile->smokesitu) . "%"]])
                        ->orWhere([['smokesitu', 'like', '%不限%']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['smokesitu', 'like', '%不限%']]);
                });
            }

            if ($oUser->xapp1s1profile->drinksitu) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['drinksitu', 'like', "%" . trim($oUser->xapp1s1profile->drinksitu) . "%"]])
                        ->orWhere([['drinksitu', 'like', '%不限%']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['drinksitu', 'like', '%不限%']]);
                });
            }

            if ($oUser->xapp1s1profile->childrensitu) {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['childrensitu', 'like', "%" . trim($oUser->xapp1s1profile->childrensitu) . "%"]])
                        ->orWhere([['childrensitu', 'like', '%不限%']]);
                });
            } else {
                $query = $query->where(function ($q) use ($oUser) {
                    $q->where([['childrensitu', 'like', '%不限%']]);
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

    public function getTheActivateDetail(Request $request, xapp1s1activate $xapp1s1activate)
    {
        $aRet = [];
        if ($xapp1s1activate) {
            $oItems = xapp1s1activate::with(['slots.user_pub'])->where([['id', $xapp1s1activate->id]])->get();
            $aRet = array_merge([
                    'success' => true,
                    'data' => $oItems]
            );
        } else {
            $aRet = ['error' => 'Invalid activate.'];

        }
        return response()->json($aRet);
    }

    public function signupTheActivate(Request $request, xapp1s1slot $xapp1s1slot)
    {
        // 初始返回数组
        $aRet = [];
        if ($xapp1s1slot) {
            $xapp1s1slot->user()->associate($request->user()->id);
            $cntTest = xapp1s1slot::where([['xapp1s1activate_id', $xapp1s1slot->xapp1s1activate_id], ['user_id', $request->user()->id]])->count();
            if ($cntTest > 0) {
                $aRet = ['error' => 'Activate signup already.'];
            } else {
                if ($xapp1s1slot->save()) {
                    $oItems = xapp1s1activate::with(['slots.user_pub'])->where([['id', $xapp1s1slot->xapp1s1activate_id]])->get();
                    $aRet = array_merge([
                            'success' => true,
                            'data' => $oItems]
                    );
                } else {
                    $aRet = ['error' => 'Slot saved failed.'];
                }
            }

        } else {
            $aRet = ['error' => 'Invalid slot.'];

        }
        return response()->json($aRet);
    }

    public function giveupTheActivate(Request $request, xapp1s1slot $xapp1s1slot)
    {
        // 初始返回数组
        $aRet = [];
        if ($xapp1s1slot) {
            $cntTest = xapp1s1slot::where([['id', $xapp1s1slot->id], ['user_id', $request->user()->id]])->count();
            if ($cntTest <= 0) {
                $aRet = ['error' => 'None sing up slot.'];
            } else {
                $xapp1s1slot->user()->disssociate($request->user()->id);
                if ($xapp1s1slot->save()) {
                    $oItems = xapp1s1activate::with(['slots.user_pub'])->where([['id', $xapp1s1slot->xapp1s1activate_id]])->get();
                    $aRet = array_merge([
                            'success' => true,
                            'data' => $oItems]
                    );
                } else {
                    $aRet = ['error' => 'Slot saved failed.'];
                }
            }

        } else {
            $aRet = ['error' => 'Invalid slot.'];

        }
        return response()->json($aRet);
    }
}
