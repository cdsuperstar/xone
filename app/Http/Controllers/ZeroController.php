<?php

namespace App\Http\Controllers;

use App\Models\z_module;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Exception;


class ZeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reqThePermission(Request $request)
    {
        // 检查是否有这个权限，没有就新加
        $retArr = [];
        $input = $request->input();
        try {
            $oPerms = Permission::findByName($input['name']);
        } catch (Exception $exception) {
            $oPerms = Permission::create($input);
        }
        $retArr = array_merge([
            'success' => true,
        ], ['data' => $oPerms]
        );
        return response()->json($retArr);
    }


    public function getRoleModules(Request $request, Role $role)
    {
        $retArr = [];
        if ($role) {
            $retArr = array_merge([
                'success' => true,
            ], ['data' => $role->modules()->pluck('id')]
            );
        } else {
            $retArr = ['error' => 'Not found.', 'code' => 1];
        }
        return response()->json($retArr);
    }

    public function uploadMyTmpFiles(Request $request)
    {
//        $request->user()->clearMediaCollection('userTmpFiles');

        if ($request->files->count()) {
            foreach ($request->files->all() as $item) {
                $sOName = str_replace(['#', '/', '\\', ' '], '-', $item->getClientOriginalName());
                $request->user()
                    ->getMedia('userTmpFiles')
                    ->each(function ($fileAdder) use ($sOName) {
                        if ($fileAdder->file_name == $sOName) {
                            $fileAdder->delete();
                        }
                    });
                // 单文件时文件名有效
                $retArr = ['name' => $sOName];

                $request->user()
                    ->addAllMediaFromRequest()
                    ->each(function ($fileAdder) {
                        $fileAdder
                            ->sanitizingFileName(function ($fileName) {
                                return str_replace(['#', '/', '\\', ' '], '-', $fileName);
                            })
                            ->toMediaCollection('userTmpFiles');
                    });
            }

        }
        return response()->json($retArr);
    }

    public function delMyTmpFiles(Request $request)
    {
        $retArr = [];
        if (count($request->input("filenames")) > 0) {
            foreach ($request->input("filenames") as $item) {
                $sOName = str_replace(['#', '/', '\\', ' '], '-', $item["name"]);
                $request->user()
                    ->getMedia('userTmpFiles')
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

    public function getMyTmpFiles(Request $request)
    {
        $media = [];
        $request->user()
            ->getMedia('userTmpFiles')
            ->each(function ($fileAdder) use (&$media) {
                $media[] = ['name' => $fileAdder->file_name, 'url' => $fileAdder->getFullUrl()];
            });
        // 单文件时文件名有效
        $retArr = ['media' => $media];
        return response()->json($retArr);
    }

    public function setMyUsercfg(Request $request)
    {
        $retArr = [];
        $oUser = $request->user();
        if ($request->input('usercfg')) {
            $oUser->usercfg = $request->input('usercfg');
            if ($oUser->save()) {
                $retArr = ['success' => true, 'data' => $oUser];
            } else {
                $retArr = ['error' => 'SaveFailed'];
            }
        }
        return response()->json($retArr);
    }

    public function setRoleModules(Request $request, Role $role)
    {
        $retArr = [];
        $aModules = $request->input('modules');
        if (count($aModules) > 0 && $role) {
            $aMyModules = [];
            if (env('APP_ADMIN') == $request->user()->id) {
                $aMyModules = z_module::all()->find($aModules)->pluck('id')->toArray();
            } else {
                $request->user()->roles()->each(function ($i) use (&$aMyModules, $aModules) {
                    $aMyModules = array_merge($aMyModules, $i->modules()->find($aModules)->pluck('id')->toArray());
                });
            }

            $role->modules()->detach();
            $role->modules()->attach(array_unique($aMyModules));

            $retArr = array_merge([
                'success' => true,
            ], ['data' => $role->modules()->count()]
            );
        } else {
            $retArr = ['error' => 'Role or modules empty.', 'code' => 1];
        }
        return response()->json($retArr);
    }

    public function getMyPermissions(Request $request)
    {
        $retArr = [];
        // 清除临时文件
        $request->user()->clearMediaCollection('userTmpFiles');

        if ($request->input('role')) {
            $oRole = $request->user()->roles()->where(['name' => $request->input('role')])->orderby('id')->first();
        } else {
            $oRole = $request->user()->roles()->orderby('id')->first();
        }

        $oModules = [];
        $oMenuTree = [];
//        \Log::info('tmp log',[$request->user(),$request->user()->roles]);
        if ($oRole) {
            if (env('APP_ADMIN') == $request->user()->id) {
//                $oMenuTree = $oRole->modules()->defaultOrder()->get()->toTree();
                $oMenuTree = z_module::defaultOrder()->get()->toTree();
                $oModules = z_module::all();
//                $oModules = $oRole->modules()->defaultOrder()->get();
            } else {
                $oMenuTree = $oRole->modules()->defaultOrder()->get()->toTree();
                if ($oRole) {
                    $oModules = $oRole->modules()->defaultOrder()->get();
                }
            }
        }
        $oPerms = Permission::all();
        $oUnits = $request->user()->units()->get();

        $oItems = $request->user()->permissions;
        $retArr = array_merge([
            'success' => true,
            'roles' => $request->user()->roles()->orderby('id')->get(),
            'perms' => $oPerms,
            'units' => $oUnits,
            'currectrole' => $oRole,
            'modules' => $oModules,
            'moduletree' => $oMenuTree,
        ], ['data' => $oItems]);

        return response()->json($retArr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
