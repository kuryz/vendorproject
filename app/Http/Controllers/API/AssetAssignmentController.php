<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AssetAssignment;
use Notification;
use App\User;
use App\Notifications\VendorNotify;
use App\Http\Requests\AssetAssignmentFormRequest;

class AssetAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetAssignment = AssetAssignment::all();
        return response()->json([
            'status' => 'success',
            'message' => 'data fetched successfully',
            'data' => $assetAssignment
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
    public function store(AssetAssignmentFormRequest $request)
    {
        $user = User::first(); //believed to be the admin
        $assign = AssetAssignment::create([
            'asset_id' => $request->asset_id,
            'assignment_date' => $request->assignment_date,
            'status' => $request->status,
            'is_due' => $request->is_due,
            'due_date' => $request->due_date,
            'assigned_user_id' => $request->assigned_user_id,
            'assigned_by' => $request->assigned_by,
        ]);

        Notification::send($user, new VendorNotify($assign));
        return response()->json([
            'status' => 'success',
            'message' => 'created successfully',
            'data' => $assign
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
         $assign = AssetAssignment::find($id);
         return response()->json([
            'status' => 'success',
            'message' => ' successful',
            'data' => $assign
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssetAssignmentFormRequest $request, $id)
    {
        $assign = AssetAssignment::find($id);
        $assign->asset_id = $request->asset_id,
        $assign->assignment_date = $request->assignment_date,
        $assign->status = $request->status,
        $assign->is_due = $request->is_due,
        $assign->due_date = $request->due_date,
        $assign->assigned_user_id = $request->assigned_user_id,
        $assign->assigned_by = $request->assigned_by,
        $assign->save();

        return response()->json([
            'status' => 'success',
            'message' => 'assign updated successfully',
            'data' => $assign
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
        $assign = AssetAssignment::find($id);
        if($assign->delete())
            return response()->json([
                'status' => 'success',
                'message' => 'assign deleted successfully',
            ])
    }
}
