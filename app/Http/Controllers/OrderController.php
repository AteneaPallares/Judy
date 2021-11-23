<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DetailsOrder;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
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

        return view('orders.index');
    }

    public function showall() {
        //return Order::with('roles','schedule')->get();
        return Order::with ('supplier','employee') -> get();
        //return Order::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('orders.create');
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
                    'id_supplier' => 'required',
                    'id_employee' => 'required',
                ]);
                if ($validator -> fails()) {
                    return ['errors'=> $validator -> errors()];
                }
            } catch (\Exception $e) {
                return ['response'=> $e];
            }
            $edit = false;
            $new = [];
            if ($request -> id != null) {
                $edit = true;
                $new = Order:: findOrFail($request -> id);
            } else {
                $new = new Order();
            }
            $new -> id_supplier=$request -> id_supplier;
            $new -> id_employee=$request -> id_employee;
            $new -> save();
            $new->details_orders()->delete();
            foreach($request->saveproducts as $element){
                $aux=new DetailsOrder();
                $aux->id_order=$new->id;
                $aux->price=$element['price'];
                $aux->quantity=$element['quantity'];
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
        //$Order=Order::with("roles")->findOrFail($id);
        $Order = Order::with("supplier","employee","details_orders")-> findOrFail($id);
        return $Order;
    }
    public function show($id) {
        //
        $detailId = $id;
        $params = [
            'detailN' => $detailId
        ];
        return view('orders/detail', $params);
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
        return view('orders/edit', $params);

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
            $Order = Order:: findOrFail($id);
            $Order -> save();
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
                $Order = Order::findOrFail($id);
                $Order->details_orders()->delete();
                $Order->delete();
                return 1;
            } catch (\Illuminate\Database\QueryException $e) {
                return 0;
            }
        }
    }

}
