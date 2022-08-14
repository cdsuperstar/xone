<?php

namespace App\Http\Controllers;

use App\Models\z_module;
use App\Models\Role;
use Illuminate\Http\Request;

class ZModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $oItems = z_module::all()->sortBy('id')->values()->all();
        $aReturn = ["success" => true, "data" => $oItems];
        return response()->json($aReturn);
    }

    public function getSelfLowModules(Request $request, Role $role)
    {
        //
        $oItems = $role->modules()->get();
        $aReturn = ["success" => true, "data" => $oItems];
        return response()->json($aReturn);
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

    public function setModuleTree(Request $request, z_module $z_module)
    {
        $z_module->reBuildTree($request->input());

        return response()->json(array_merge([
                'success' => true,
            ], ['data' => $z_module]
            )
        );
    }

    public function getMyMenu(Request $request, Role $role)
    {
        if (env('APP_ADMIN') == $request->user()->id) {
            $res = z_module::defaultOrder()->get()->toTree();
        } else {
            $res = $role->modules()->defaultOrder()->get()->totree();
        }
        return response()->json(array_merge([
                'success' => true,
            ], ['data' => $res]
            )
        );
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
        $rec = new z_module($request->toArray());
        if ($rec->save()) {
            return response()->json(array_merge([
                    'messages' => $rec->id,
                    'success' => true
                ], ['data' => $rec->toArray()]
                )
            );
        }
        return response()->json(['error' => $rec->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\models\z_module $z_module
     * @return \Illuminate\Http\Response
     */
    public function show(z_module $z_module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\models\z_module $z_module
     * @return \Illuminate\Http\Response
     */
    public function edit(z_module $z_module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\models\z_module $z_module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, z_module $z_module)
    {
        //
        if ($z_module) {

            if ($z_module->update($request->toArray())) {
                return response()->json(array_merge([
                        'success' => true,
                    ], ['data' => $z_module->toArray()]
                    )
                );
            } else {
                return response()->json(['error' => 'Update failed']);
            }
        }
        return response()->json(['error' => 'Unknow Err']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\models\z_module $z_module
     * @return \Illuminate\Http\Response
     */
    public function destroy(z_module $z_module)
    {
        //
        if ($z_module->delete()) {

            return response()->json(array_merge([
                'messages' => $z_module->id,
                'success' => true,
            ], ['data' => $z_module->toArray()]));
        } else {
            return response()->json(['error' => trans('data.destroyfailed', ['data' => $z_module->id])]);
        }
    }
}
