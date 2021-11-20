<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\DetailsSale;
class SaleController extends Controller
{
    public function __construct() {
        $this -> middleware('auth');
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
            $new->details_sales()->delete();
            foreach($request->saveproducts as $element){
                $aux=new DetailsSale();
                $aux->id_sales=$new->id;
                $aux->cost=$element['cost'];
                $aux->quantiy=$element['quantity'];
                $aux->id_product=$element['id'];
                $aux->save();
            }
            return ['response'=> $new -> id];
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
    public function destroy($id) {
        //
        if (request() -> isMethod("DELETE")) {
            try {
                $Sale = Sale::findOrFail($id);
                $Sale->details_sales()->delete();
                $Sale->delete();
                return 1;
            } catch (\Illuminate\Database\QueryException $e) {
                return 0;
            }
        }
    }

}
