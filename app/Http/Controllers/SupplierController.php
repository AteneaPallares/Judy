<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller {
    //
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

        return view('suppliers.index');
    }

    public function showall() {
        //return Supplier::with('roles','schedule')->get();
        return Supplier::all();
        //return Supplier::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('suppliers.create');
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
            $supplier = Supplier:: findOrFail($request -> deleteImage);
            if ($supplier -> img != null) {
                Storage:: delete ('public/'.$supplier -> img);
            }
            $supplier -> img=null;
            $supplier -> save();
            return 1;
        }
        if ($request -> editImage != NULL) {
            if ($request -> hasFile('imagen')) {
                $supplier = Supplier:: findOrFail($request -> editImage);
                Storage:: delete ('public/proveedores/'.$supplier -> img);
                $stri = "proveedores".($supplier -> id).'.'.$request -> file('imagen') -> extension();;
                $path = $request -> imagen -> storeAs('proveedores', $stri, 'public');
                $supplier -> img=$path;
                DB:: beginTransaction();
                DB:: commit();
                $supplier -> save();
                return 7;
            }
            return 3;
        }
        try {
            $edit = false;
            $new = [];
            if ($request -> id != null) {

                $edit = true;
                $new = Supplier:: findOrFail($request -> id);
            } else {

                $new = new Supplier();
            }
            $new -> name=$request -> name;
            $new -> enterprise=$request -> enterprise;
            $new -> email=$request -> email;
            $new -> phone=$request -> phone;
            if ($request -> hasFile('imagen')) {
                $stri = "proveedores".($supplier -> id).'.'.$request -> file('imagen') -> extension();;
                $path = $request -> imagen -> storeAs('proveedores', $stri, 'public');
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
        //$supplier=Supplier::with("roles")->findOrFail($id);
        $supplier = Supplier:: findOrFail($id);
        return $supplier;
    }
    public function show($id) {
        //
        $detailId = $id;
        $params = [
            'detailN' => $detailId
        ];
        return view('suppliers/detail', $params);
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
        return view('suppliers/edit', $params);

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
            $supplier = Supplier:: findOrFail($id);
            $supplier -> save();
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
                $supplier = Supplier:: findOrFail($id);
                if ($supplier -> img != null) {
                    Storage:: delete ('public/'.$supplier -> img);
                }
                $supplier -> delete ();
                return 1;
            } catch (\Illuminate\Database\QueryException $e) {
                return 0;
            }
        }
    }

}
