<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class ZRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $oItems = Role::all()->sortBy('id')->values()->all();
        $aRet = ["success" => true, "data" => $oItems];
        return response()->json($aRet);
    }

    public function getSelfOrLowRoles(Request $request, Role $role)
    {
        $aRet = [];
        $oItems = Role::all()->filter(function ($value) use ($role) {
            return $value->modules()->pluck('id')->diff($role->modules()->pluck('id'))->count() == 0;
        })->values();

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
        $rec = new Role($request->input());
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
     * @param \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $aRet = [];
        if ($role) {

            if ($role->update($request->toArray())) {
                $aRet = array_merge([
                    'success' => true,
                ], ['data' => $role]
                );
            } else {
                $aRet = ['error' => $role->errors()->all()];
            }
        }
        return response()->json($aRet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $aRet = [];
        if ($role->delete()) {

            $aRet = array_merge([
                'messages' => $role->id,
                'success' => true,
            ], ['data' => $role]);
        } else {
            $aRet = ['error' => trans('data.destroyfailed', ['data' => $role->id])];
        }
        return response()->json($aRet);
    }
}
