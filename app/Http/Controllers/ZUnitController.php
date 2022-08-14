<?php

namespace App\Http\Controllers;

use App\Models\z_unit;
use Illuminate\Http\Request;

class ZUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $oItems = z_unit::all()->sortBy('id')->values()->all();
        $aRet = ["success" => true, "data" => $oItems];
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

    public function getUnitTree(Request $request)
    {
        $root = z_unit::first();
        $res = $root->defaultOrder()->get()->totree();
        return response()->json(array_merge([
                'success' => true,
            ], ['data' => $res]
            )
        );
    }

    public function getTheUnitTree(Request $request, z_unit $z_unit)
    {
        $res = z_unit::defaultOrder()->descendantsAndSelf($z_unit)->toTree();
        return response()->json(array_merge([
                'success' => true,
            ], ['data' => $res]
            )
        );
    }

    public function setUnitTree(Request $request, z_unit $z_unit)
    {
        $z_unit->reBuildTree($request->input());

        return response()->json(array_merge([
                'success' => true,
            ], ['data' => $z_unit]
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
        $rec = new z_unit($request->input());
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
     * @param z_unit $z_unit
     * @return \Illuminate\Http\Response
     */
    public function show(z_unit $z_unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param z_unit $z_unit
     * @return \Illuminate\Http\Response
     */
    public function edit(z_unit $z_unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param z_unit $z_unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, z_unit $z_unit)
    {
        //
        $aRet = [];
        if ($z_unit) {

            if ($z_unit->update($request->toArray())) {
                $aRet = array_merge([
                    'success' => true,
                ], ['data' => $z_unit]
                );
            } else {
                $aRet = ['error' => 'Update failed'];
            }
        }
        return response()->json($aRet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param z_unit $z_unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(z_unit $z_unit)
    {
        //
        $aRet = [];
        if ($z_unit->delete()) {

            $aRet = array_merge([
                'messages' => $z_unit->id,
                'success' => true,
            ], ['data' => $z_unit]);
        } else {
            $aRet = ['error' => trans('data.destroyfailed', ['data' => $z_unit->id])];
        }
        return response()->json($aRet);

    }
}
