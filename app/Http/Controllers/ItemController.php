<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Item;
use App\Models\Pajak;
use App\Models\ItemPajak;
use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $result = Item::select('id','nama')->with(['pajak'])->get();
        
        $result = DB::select("select i.id ,i.`nama` ,json_array( (select GROUP_CONCAT( json_object('id',pajak_id,'nama',pajaks.nama,'rate',concat(pajaks.rate,'%')) ) from item_pajaks join pajaks on pajaks.id = item_pajaks.pajak_id where item_id = i.id)) as pajak from items i");
        foreach($result as $a){
            $b = json_decode($a->pajak,true);
            $a->pajak = $b;
            
        }                
        
        return response()->json(["data"=>$result]);
        

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
        $validator = Validator::make(['nama' => $request->nama,'pajak' => $request->pajak],['nama'=>'required','pajak'=>'required|array|min:2']);
        if ($validator->fails()) {           
            return response()->json(['errors' => $validator->errors()]);
        }
        
        try{
            $data = new Item;
            $data->nama = $request->nama;            
            $data->save();   

            $pajak = Pajak::find($request->pajak);
            $data->pajaks()->attach($pajak);
            
            return response()->json([
                'status' => "1",
                'message' => "Create Item Success!"
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
        // return $request;
        $validator = Validator::make(['nama' => $request->nama,'pajak' => $request->pajak],['nama'=>'required','pajak'=>'required|array|min:2']);
        if ($validator->fails()) {           
            return response()->json(['errors' => $validator->errors()]);
        }
        try{
            $data = Item::find($id);
            $data->nama = $request->nama;
            $data->update();

            $data->pajaks()->sync($request->pajak);
            // $detail = ItemPajak::where("item_id",$id);
            // $detail->delete();
            // foreach($request->pajak as $a){
            //     $dataDetail = new ItemPajak;
            //     $dataDetail->item_id = $data->id;
            //     $dataDetail->pajak_id = $a;
            //     $dataDetail->save();
            // }
            return response()->json([
                'status' => "1",
                'message' => "Update Item Success!"
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
            $data = Item::find($id)->delete();            
            return response()->json([
                'status' => "1",
                'message' => "Delete Item Success!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => "0",
                'error' => $e->getMessage()
            ]);
        }
        
    }
}
