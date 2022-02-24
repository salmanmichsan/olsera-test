<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Pajak;

class PajakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
        $validator = Validator::make(['nama' => $request->nama,'rate' => $request->rate],['nama'=>'required','rate'=>'required|between:0,100.00']);
        if ($validator->fails()) {           
            return response()->json(['errors' => $validator->errors()]);
        }
        
        try{
            $data = new Pajak;
            $data->nama = $request->nama;            
            $data->rate = $request->rate;            
            $data->save();   
            
            return response()->json([
                'status' => "1",
                'message' => "Create Pajak Success!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => "0",
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $validator = Validator::make(['nama' => $request->nama,'rate' => $request->rate],['nama'=>'required','rate'=>'required|between:0,100.00']);
        if ($validator->fails()) {           
            return response()->json(['errors' => $validator->errors()]);
        }
        try{
            $data = Pajak::find($id);
            $data->nama = $request->nama;            
            $data->rate = $request->rate;            
            $data->update();   
            
            return response()->json([
                'status' => "1",
                'message' => "Update Pajak Success!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => "0",
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data = Pajak::find($id)->delete();
            return response()->json([
                'status' => "1",
                'message' => "Delete Pajak Success!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => "0",
                'error' => $e->getMessage()
            ]);
        }
    }
}
