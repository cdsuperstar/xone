<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\z_userprofile;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = User::all();
        return response()->json(array_merge([
                'success' => true
            ], ['data' => $res]
            )
        );
    }

    public function getUserUnit(Request $request, User $user)
    {
        $aRet = [];
        $aObjects = $user->units()->get();
        $aRet = ['success' => true, 'data' => $aObjects];
        return response()->json($aRet);
    }

    public function setUserUnit(Request $request)
    {
        $aRet = [];
        $aUsers = User::find($request->input('users'));
        $aUnits = $request->input('units');
        $iUsers = 0;
        $aUsers->each(function ($user) use (&$iUsers, $aUnits) {
            $user->units()->detach();
            $user->units()->attach($aUnits);
            $user->userprofile->unitid = $aUnits[0];
            $user->userprofile->save();

            $iUsers++;
        });

        $aRet = ['success' => true, 'data' => $iUsers];
        return response()->json($aRet);
    }


    public function getUserRoles(Request $request, User $user)
    {
        $aRet = [];
        $aObjects = $user->roles()->get();
        $aRet = ['success' => true, 'data' => $aObjects];
        return response()->json($aRet);
    }

    public function getUsersPermisstionCfgs(Request $request)
    {
        $aRet = [];
        if ($request->input('users')) {
            $aUsers = $request->input('users');
            $aUsers = User::find($aUsers);
            $bSingleUser = false;
            if (count($aUsers) == 1) $bSingleUser = true;
            $aModules = collect();
            $aUsrCfg = collect();
            if (count($aUsers) > 0) {
                Role::find($aUsers->each->roles->pluck('roles')->flatten()->pluck('id')->unique()->values())->each(function ($val) use (&$aModules) {
                    $aModules = $aModules->concat($val->modules()->get(['id', 'name', 'title']));
                });
                $aModules = $aModules->values()->unique('name');
                $aModules = $aModules->filter(function ($val) use ($bSingleUser) {
                    return count($val->permissions = Permission::where('name', 'like', $val->name . '.%')->get());
                });
                if ($bSingleUser) {
                    $aUsers[0]->permissions()->each(function ($val) use (&$aUsrCfg) {
                        $aUsrCfg[$val->name] = $val->pivot->usrcfg;
                    });
                    $aModules->each(function ($mod) use ($aUsrCfg) {
                        $mod->permissions->each(function ($perm) use ($aUsrCfg) {
                            if (isset($aUsrCfg[$perm->name]))
                                $perm->usrcfg = $aUsrCfg[$perm->name];
                        });
                    });
                }

            }
            $aRet = ['success' => true, 'data' => $aModules];

        }
        return response()->json($aRet);
    }

    public function setUsersPermissionCfgs(Request $request)
    {
        $aRet = [];
        $aUsers = User::find($request->input('users'));
        $aPermissions = $request->input('permissions');
        $iUsers = 0;
        $iPerms = 0;
        if ($aUsers) {
            $aUsers->each(function ($user) use ($aPermissions, &$iUsers, &$iPerms) {
                $iUsers++;
                foreach ($aPermissions as $perm) {
                    $iPerms++;
                    $user->permissions()->detach($perm["id"]);
                    if (isset($perm["usrcfg"]))
                        $user->permissions()->attach($perm["id"], ["usrcfg" => $perm["usrcfg"]]);
                }
            });
            $aRet = ["success" => true, "data" => ["users" => $iUsers, "perms" => $iPerms]];
        }
        return response()->json($aRet);
    }

    public function setUsersRoles(Request $request)
    {
        $aUsers = $request->input('users');
        $sRoles = $request->input('roles');
        $iU = 0;
        $iR = 0;
        $aRet = [];
        User::find($aUsers)->each(function ($i) use ($sRoles, &$iU, &$iR) {
            $iU++;
            try {
                $i->roles()->detach($i->roles()->get());
                $i->roles()->attach($sRoles);
                $iR += count($sRoles);
            } catch (Exception $e) {
            }
        });
        $aRet = ['success' => true, 'data' => ['users' => $iU, 'roles' => $iR]];
        return response()->json($aRet);
    }

    public function setMyPassword(Request $request)
    {
        $aRet = [];
        if ($request->get("oldpwd") == "" || $request->get("newpwd") == "") {
            $aRet = ["code" => 1, 'error' => "密码不得为空！"];
        }
        $rec = User::find($request->user()->id);
        if (!Hash::check($request->get("oldpwd"), $rec->password)) {
            $aRet = ["code" => 2, 'error' => "旧密码不正确！"];
        }
        $rec->password = $request->get("newpwd");
        if ($rec->save()) {
            $aRet = array_merge([
                'messages' => 'SetPasswordSuccess',
                'success' => true,
            ], ["data" => $rec]
            );
        } else {
            $aRet = ['error' => 'Save failed'];
        }
        return response()->json($aRet);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $aRet = [];
        $user = new User();
        if ($user) {
            foreach ($request->input() as $key => $val) {
                $user->$key = $val;
            }

            if ($user->save()) {

                $recuserprofile = new z_userprofile();
                $recuserprofile->id = $user->id;
                $recuserprofile->name = $user->name;
                $recuserprofile->save();

                $aRet = array_merge([
                    'messages' => 'NewStoreSuccess',
                    'success' => true,
                ], ['data' => $user]
                );
            }
        } else {
            $aRet = ['error' => 'User not exist'];
        }
        return response()->json($aRet);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if (!$user) return false;
        $aRet = [];
        $user = User::find($user->id);
        if ($user) {
            $aTmp = array();
            foreach ($request->input() as $key => $val) {
                $aTmp[$key] = $val;
            }
            $user->fill($aTmp);
            if ($user->save()) {
                $aRet = array_merge([
                    'messages' => 'UpdateSucess',
                    'success' => true,
                ], ['data' => $user]
                );
            } else {
                $aRet = ['error' => 'Save failed'];
            }
        }
        return response()->json($aRet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        $aRet = [];
        if (!User::find($user->id)) {
            $aRet =
                array_merge(
                    [
                        'messages' => 'DeleteSuccess',
                        'success' => true,
                    ],
                    ['data' => $user]
                );
        } else {
            $aRet = ['error' => 'UserNotFound'];
        }
        return response()->json($aRet);
    }

    public function self()
    {
        $aReturn = ["success" => true, "data" => User::with(['xapp1s1profile_pub'])->where('id', auth('api')->user()->id)->first()];
//        $aReturn = ["success" => true, "data" => auth('api')->user()];
        return response()->json($aReturn);
    }

    // 关注或者取消关注
    public function likeTheUser(Request $request, User $user)
    {
        $aRet = [];
        $tmpContent = 1;
        if ($request->input('content')) {
            $tmpContent = $request->input('content');
        }
        if ($request->user()->like()->where('user_id', $user->id)->where('content', $tmpContent)->count() > 0) {
            if ($request->user()->where('user_id', $user->id)->where('content', $tmpContent)->delete()) {
                $aRet = ['success' => true, 'data' => $request->user()->like()->get(['id', 'user_id', 'content'])];
            } else {
                $aRet = ['error' => 'Like cancel failed!'];
            }
        } else {
            if ($request->user()->like()->create(['content' => $tmpContent])->user_pub()->associate($user->id)->save()) {
                $aRet = ['success' => true, 'data' => $request->user()->like()->get(['id', 'user_id', 'content'])];
            } else {
                $aRet = ['error' => 'Like failed!'];
            }
        }
        return response()->json($aRet);
    }

}
