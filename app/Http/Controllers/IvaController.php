<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iva;
use Illuminate\Support\Facades\Validator;

class IvaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        //
        return view('iva.index');
    }
    public function showall()
    {
        return Iva::all();
    }
    /**ind
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('iva.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            try {
                $validator = Validator:: make($request -> all(), [
                    'porcentage' => 'required',
                ]);
                if ($validator -> fails()) {
                    return ['errors'=> $validator -> errors()];
                }
            } catch (\Exception $e) {
                return ['response'=> $e];
            }
            $iva=[];
            if($request->id==null){
                $iva=new Iva();
            }else{
                $iva = Iva::findOrFail($request -> id);
            }
            $iva->porcentage=$request->porcentage;
            $iva->start=$request->start;
            $iva->save();
            return ['response'=>$iva->id];
        }
        catch(\Exception $exception){
            return $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showone($id){
        $iva=Iva::findOrFail($id);
        return $iva;
    }
    public function show($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('iva/detail',$params);
    }
    public function showedit($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('iva/edit',$params);

    }
    public function getactual(){
        return IVA::orderBy('start', 'asc')->get();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(request()->isMethod("DELETE")){
            try{
                $iva=Iva::findOrFail($id);
                $iva->delete();
                return 1;
            }catch(\Illuminate\Database\QueryException $e){
                return 0;
            }
            
        }
    }
}
