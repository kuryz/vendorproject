<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssetFormRequest
use App\Asset;
use DB;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::all();
        return response()->json([
            'status' => 'success',
            'message' => 'asset data fetched successfully',
            'data' => $assets
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetFormRequest $request)
    {
        $asset = Asset::create([
            'type' => $request->type,
            'serial_number' => $request->serial_number,
            'description' => $request->description,
            'picture_path' => $request->picture_path,
            'purchase_date' => $request->purchase_date,
            'start_use_date' => $request->start_use_date,
            'purchase_price' => $request->purchase_price,
            'warranty_expiry_date' => $request->warranty_expiry_date,
            'degradation' => $request->degradation,
            'current_value' => $request->current_value,
            'location' => $request->location,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'asset created successfully',
            'data' => $asset
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset = Asset::find($id);
        return response()->json([
            'status' => 'success',
            'message' => ' successful',
            'data' => $asset
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssetFormRequest $request, $id)
    {
        $asset = Asset::find($id);
        $asset->type = $request->type;
        $asset->serial_number = $request->serial_number;
        $asset->description = $request->description;
        $asset->picture_path = $request->picture_path;
        $asset->purchase_date = $request->purchase_date;
        $asset->start_use_date = $request->start_use_date;
        $asset->purchase_price = $request->purchase_price;
        $asset->warranty_expiry_date = $request->warranty_expiry_date;
        $asset->degradation = $request->degradation;
        $asset->current_value = $request->current_value;
        $asset->location = $request->location;
        $asset->save();

        return response()->json([
            'status' => 'success',
            'message' => 'asset updated successfully',
            'data' => $asset
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = Asset::find($id);
        if($asset->delete())
            return response()->json([
                'status' => 'success',
                'message' => 'asset deleted successfully',
            ]);
    }
}
