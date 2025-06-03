<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndustriApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industri = \App\Models\Industri::all();
        return response()->json([
            'success' => true,
            'message' => 'List  Industri',
            'data' => $industri
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'kontak' => 'required|string|max:20',
        ]);

        $industri = \App\Models\Industri::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Industri created successfully',
            'data' => $industri
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $industri = \App\Models\Industri::find($id);
        if (!$industri) {
            return response()->json([
                'success' => false,
                'message' => 'Industri not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Industri details',
            'data' => $industri
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $industri = \App\Models\Industri::find($id);
        if (!$industri) {
            return response()->json([
                'success' => false,
                'message' => 'Industri not found',
            ], 404);
        }

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'kontak' => 'required|string|max:20',

        ]);

        $industri->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Industri updated successfully',
            'data' => $industri
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $industri = \App\Models\Industri::find($id);
        if (!$industri) {
            return response()->json([
                'success' => false,
                'message' => 'Industri not found',
            ], 404);
        }
        $industri->delete();
        return response()->json([
            'success' => true,
            'message' => 'Industri deleted successfully',
        ]);
    }
}
