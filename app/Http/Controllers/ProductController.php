<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
    //
    public function __construct() {
        $this -> middleware('auth')->except('showall');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //

        return view('products.index');
    }

    public function showall() {
        //return Product::with('roles','schedule')->get();
        return Product::all();
        //return Product::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
       
        if ($request -> deleteImage != NULL) {
            $product = Product:: findOrFail($request -> deleteImage);
            if ($product -> img != null) {
                Storage:: delete ('public/'.$product -> img);
            }
            $product -> img=null;
            $product -> save();
            return 1;
        }
        if ($request -> editImage != NULL) {
            if ($request -> hasFile('imagen')) {
                $product = Product:: findOrFail($request -> editImage);
                Storage:: delete ('public/productos/'.$product -> img);
                $stri = "productos".($product -> id).'.'.$request -> file('imagen') -> extension();;
                $path = $request -> imagen -> storeAs('productos', $stri, 'public');
                $product -> img=$path;
                DB:: beginTransaction();
                DB:: commit();
                $product -> save();
                return 7;
            }
            return 3;
        }
        try {
            try {
                $validator = Validator:: make($request -> all(), [
                    'name' => 'required',
                    'stock' => 'required',
                    'cost'=>'required'
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
                $new = Product:: findOrFail($request -> id);
            } else {

                $new = new Product();
            }
            $new -> name=$request -> name;
            $new -> stock=$request -> stock;
            $new -> description=$request -> description;
            $new -> cost=$request -> cost;
          
          
           // $new -> birthdate=$request -> birthdate;
            //$new -> phone=$request -> phone;
           // $new -> gender=$request -> gender;
          //  $new -> status=$request -> status;
           // $new -> id_role=$request -> role;
            if ($request -> hasFile('imagen')) {
                $stri = "productos".($product -> id).'.'.$request -> file('imagen') -> extension();;
                $path = $request -> imagen -> storeAs('productos', $stri, 'public');
                $new -> img=$path;
            }
            $new -> save();
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
        //$product=Product::with("roles")->findOrFail($id);
        $product = Product:: findOrFail($id);
        return $product;
    }
    public function show($id) {
        //
        $detailId = $id;
        $params = [
            'detailN' => $detailId
        ];
        return view('Products/detail', $params);
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
        return view('Products/edit', $params);

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
            $product = Product:: findOrFail($id);
            $product -> save();
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
                $product = Product:: findOrFail($id);
                if ($product -> img != null) {
                    Storage:: delete ('public/'.$product -> img);
                }
                $product -> delete ();
                return 1;
            } catch (\Illuminate\Database\QueryException $e) {
                return 0;
            }
        }
    }

}
