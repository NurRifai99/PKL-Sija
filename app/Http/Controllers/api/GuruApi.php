<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuruApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::all();
        return response()->json([
            'success' => true,
            'message' => 'List Guru',
            'data' => $guru
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Validator([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:siswas,nis',
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);
        if ($data->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $data->errors()
            ], 422);
        }

        $guru = Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'email' => $request->email,
            
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guru = Guru::find($id);
        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Guru not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Guru details',
            'data' => $guru
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = Guru::find($id);
        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Guru not found'
            ], 404);
        }
        $guru->delete();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = Guru::find($id);
        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'guru not found',
            ], 404);
        }
        $guru->delete();
    }
}
