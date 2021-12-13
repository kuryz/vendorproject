<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();
        return response()->json([
            'status' => 'success',
            'message' => 'vendor data fetched successfully',
            'data' => $vendors
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
    public function store(VendorFormRequest $request)
    {
        
        $vendor = Vendor::create([
            'name' => $request->name,
            'category' => $request->category,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'vendor created successfully',
            'data' => $vendor
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
        $vendor = Vendor::find($id);
        return response()->json([
            'status' => 'success',
            'message' => ' successful',
            'data' => $vendor
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
    public function update(VendorFormRequest $request, $id)
    {
        $vendor = Vendor::find($id);
        $vendor->name = $request->name;
        $vendor->category = $request->category;
        $vendor->save();

        //
        return response()->json([
            'status' => 'success',
            'message' => 'vendor updated successfully',
            'data' => $vendor
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
        $vendor = Vendor::find($id);
        if($vendor->delete())
            return response()->json([
                'status' => 'success',
                'message' => 'vendor deleted successfully',
            ]);
    }
}
