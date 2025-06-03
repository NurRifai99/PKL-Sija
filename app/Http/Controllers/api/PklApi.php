<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PklApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pkl = \App\Models\Pkl::with(['siswa', 'industri','guru'])->get();
        return response()->json([
            'success' => true,
            'message' => 'List  PKL',
            'data' => $pkl
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pkl = \App\Models\Pkl::with(['siswa', 'industri','guru'])->find($id);
        if (!$pkl) {
            return response()->json([
                'success' => false,
                'message' => 'Pkl not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Detail Pkl',
            'data' => $pkl
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pkl = \App\Models\Pkl::find($id);
        if (!$pkl) {
            return response()->json([
                'success' => false,
                'message' => 'Pkl not found',
            ], 404);
        }

        $pkl->delete();
        return response()->json([
            'success' => true,
            'message' => 'Pkl deleted successfully',
        ]);
    }
}
