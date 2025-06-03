<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = \App\Models\Siswa::all();
        return response()->json([
            'success' => true,
            'message' => 'List  Siswa',
            'data' => $siswa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Validator([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswas,nis',
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'status_pkl' => 'in:sudah,belum',
        ]);
        if ($data->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $data->errors()
            ], 422);
        }

        $siswa = \App\Models\Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'email' => $request->email,
            'status_pkl' => $request->status_pkl ?? 'belum',

        ]);


        return response()->json([
            'success' => true,
            'message' => 'Siswa created successfully',
            'data' => $siswa
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = \App\Models\Siswa::find($id);
        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Siswa details',
            'data' => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Validator([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswas,nis',
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'status_pkl' => 'in:sudah,belum',
        ]);
        if ($data->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $data->errors()
            ], 422);
        }
        $siswa = Siswa::find($id);

        $siswa->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'email' => $request->email,
            'status_pkl' => $request->status_pkl ?? 'belum',

        ]);


        return response()->json([
            'success' => true,
            'message' => 'Siswa created successfully',
            'data' => $siswa
        ], 201);

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
