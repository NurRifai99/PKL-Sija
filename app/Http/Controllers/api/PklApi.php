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
        $data = $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ], [
            'after' => 'Tanggal selesai harus setelah tanggal mulai.',
        ]);
        $siswa_id = auth()->user()->siswa->id;
        if (!\App\Models\Pkl::where('siswa_id', $siswa_id)->exists()) {
            $pkl = \App\Models\Pkl::create([
                'siswa_id' => $siswa_id,
                'guru_id' => $data['guru_id'],
                'industri_id' => $data['industri_id'],
                'tanggal_mulai' => $data['tanggal_mulai'],
                'tanggal_selesai' => $data['tanggal_selesai'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'PKL created successfully',
                'data' => $pkl
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah terdaftar PKL',
            ], 400);
        }

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
        $pkl = \App\Models\Pkl::find($id);
        if (!$pkl) {
            return response()->json([
                'success' => false,
                'message' => 'Pkl not found',
            ], 404);
        }

        $data = $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ], [
            'after' => 'Tanggal selesai harus setelah tanggal mulai.',
        ]);

        $pkl->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Pkl updated successfully',
            'data' => $pkl
        ]);
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
