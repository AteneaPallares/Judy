<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\DetailsSale;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //

        return view('sales.index');
    }

    public function showall() {
        //return Sale::with('roles','schedule')->get();
        return Sale::with ('client','employee') -> get();
        //return Sale::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        try {
            try {
                $validator = Validator:: make($request -> all(), [
                    'id_client' => 'required',
                    'id_employee' => 'required',
                ]);
                if ($validator -> fails()) {
                    return ['response'=> $validator -> errors()];
                }
            } catch (\Exception $e) {
                return ['response'=> $e];
            }
            $edit = false;
            $new = [];
            if ($request -> id != null) {
                $edit = true;
                $new = Sale:: findOrFail($request -> id);
            } else {
                $new = new Sale();
            }
            $new -> id_client=$request -> id_client;
            $new -> id_employee=$request -> id_employee;
            $new -> save();
            foreach($new->details_sales as $element){
                $auxp=Product::findorfail($element['id_product']);
                $auxp->stock+=$element['quantiy'];
                $auxp->save();
            }
            $new->details_sales()->delete();
            $errores="";
            foreach($request->saveproducts as $element){
                $auxp=Product::findorfail($element['id']);
                $aux=new DetailsSale();
                $aux->id_sales=$new->id;
                $aux->cost=$element['cost'];
                $aux->quantiy=$element['quantity'];
                $aux->id_product=$element['id'];
                $auxp->stock-=$aux->quantiy;
                if($auxp->stock<0){
                    $errores.=(string)$aux->id_product;
                    $errores.=", ";
                }else{
                    $aux->save();
                    $auxp->save();
                }
            }
            if($errores==""){
                return ['response'=> $new -> id];
            }
            $this->del($new->id);
            return ['response'=> $new -> id,'errors'=>$errores];
        } catch (\Exception $e) {
            return ['response'=> $e];
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showone($id) {
        //$Sale=Sale::with("roles")->findOrFail($id);
        $Sale = Sale::with("client","employee","details_sales")-> findOrFail($id);
        return $Sale;
    }
    public function show($id) {
        //
        $detailId = $id;
        $params = [
            'detailN' => $detailId
        ];
        return view('sales/detail', $params);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //


    }
    public function showedit($id) {
        //
        $detailId = $id;
        $params = [
            'detailN' => $detailId
        ];
        return view('sales/edit', $params);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        try {
            $Sale = Sale:: findOrFail($id);
            $Sale -> save();
        } catch (\Illuminate\Database\QueryException $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function del($id){
        try {
            $Sale = Sale::findOrFail($id);
            foreach($Sale->details_sales as $element){
                $auxp=Product::findorfail($element['id_product']);
                $auxp->stock+=$element['quantiy'];
                $auxp->save();
            }
            $Sale->details_sales()->delete();
            $Sale->delete();
            return 1;
        } catch (\Illuminate\Database\QueryException $e) {
            return 0;
        }
    }
    public function destroy($id) {
        //
        if (request() -> isMethod("DELETE")) {
            try {
                $Sale = Sale::findOrFail($id);
                foreach($Sale->details_sales as $element){
                    $auxp=Product::findorfail($element['id_product']);
                    $auxp->stock+=$element['quantiy'];
                    $auxp->save();
                }
                $Sale->details_sales()->delete();
                $Sale->delete();
                return 1;
            } catch (\Illuminate\Database\QueryException $e) {
                return 0;
            }
        }
    }

}
