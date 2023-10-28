<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    public function index()
    {
        $data = Warehouse::orderBy('nama', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Warehouse Ditemukan',
            'data' => $data
        ], 200);
        
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
    public function store(Request $request)
    {

        $dataWarehouse = new Warehouse;

        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data Warehouse',
                'data' => $validator->errors()
            ]);
        }

        $dataWarehouse->nama = $request->nama;
        $dataWarehouse->alamat = $request->alamat;
        

        $post = $dataWarehouse->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data Warehouse'
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
        $data = Warehouse::find($id);

        if($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data Warehouse ditemukan',
                'data' => $data
            ], 200);
        } else{
            return response()->json([
                'status' => false,
                'message' => 'Data Warehouse tidak ditemukan'
            ]);
        }
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
    public function update(Request $request, $id)
    {

        $dataWarehouse = Warehouse::find($id);

        if(empty($dataWarehouse)){
            return response()->json([
                'status' => false,
                'message' => 'Data Warehouse tidak ditemukan'
            ], 404);
        }

        $rules = [
            'nama' => 'required',
            'alamat' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan UPDATE data Warehouse',
                'data' => $validator->errors()
            ]);
        }

        $dataWarehouse->nama = $request->nama;
        $dataWarehouse->alamat = $request->alamat;

        $post = $dataWarehouse->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan UPDATE data Warehouse'
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
        $dataWarehouse = Warehouse::find($id);

        if(empty($dataWarehouse)){
            return response()->json([
                'status' => false,
                'message' => 'Data Warehouse tidak ditemukan'
            ], 404);
        }

        $post = $dataWarehouse->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan DELETE data Warehouse'
        ]);
    }
}
