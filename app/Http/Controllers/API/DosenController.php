<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Controller;

class DosenController extends Controller
{
    //
    public function index()
    {
        $dosens = Dosen::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Dosen',
            'data'    => $dosens
        ], 200);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $dosens = Dosen::findOrfail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Dosen',
            'data'    => $dosens
        ], 200);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nidn' => 'required',
            'nama' => 'required',
            'alamat'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $dosen = Dosen::create([
            'nidn'     => $request->nidn,
            'nama'   => $request->nama,
            'alamat'   => $request->alamat
        ]);

        if ($dosen) {

            return response()->json([
                'success' => true,
                'message' => 'Data Created',
                'data'    => $dosen
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data Failed to Save',
        ], 409);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */

    public function update(Request $request, Dosen $dosen)
    {

        $validator = Validator::make($request->all(), [
            'nidn'     => 'required',
            'nama'   => 'required',
            'alamat'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $dosen = Dosen::findOrFail($dosen->id);

        if ($dosen) {

            $dosen->update([
                'nidn'     => $request->nidn,
                'nama'   => $request->nama,
                'alamat'   => $request->alamat
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Updated',
                'data'    => $dosen
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data Not Found',
        ], 404);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrfail($id);

        if ($dosen) {

            $dosen->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Deleted',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data Not Found',
        ], 404);
    }
}
