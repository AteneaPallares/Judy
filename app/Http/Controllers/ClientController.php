<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientController extends Controller {
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

        return view('clients.index');
    }

    public function showall() {
        //return client::with('roles','schedule')->get();
        return Client::all();
        //return client::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('clients.create');
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
            $client = Client:: findOrFail($request -> deleteImage);
            if ($client -> img != null) {
                Storage:: delete ('public/'.$client -> img);
            }
            $client -> img=null;
            $client -> save();
            return 1;
        }
        if ($request -> editImage != NULL) {
            if ($request -> hasFile('imagen')) {
                $client = Client:: findOrFail($request -> editImage);
                Storage:: delete ('public/clientes/'.$client -> img);
                $stri = "cliente".($client -> id).'.'.$request -> file('imagen') -> extension();;
                $path = $request -> imagen -> storeAs('clientes', $stri, 'public');
                $client -> img=$path;
                DB:: beginTransaction();
                DB:: commit();
                $client -> save();
                return 7;
            }
            return 3;
        }
        try {
            $edit = false;
            $new = [];
            if ($request -> id != null) {

                $edit = true;
                $new = Client:: findOrFail($request -> id);
            } else {

                $new = new client();
            }
            $new -> name=$request -> name;
            $new -> email=$request -> email;
            $new -> address=$request -> address;
           // $new -> birthdate=$request -> birthdate;
            $new -> phone=$request -> phone;
            $new -> gender=$request -> gender;
          //  $new -> status=$request -> status;
           // $new -> id_role=$request -> role;
            if ($request -> hasFile('imagen')) {
                $stri = "cliente".($client -> id).'.'.$request -> file('imagen') -> extension();;
                $path = $request -> imagen -> storeAs('clientes', $stri, 'public');
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
        //$client=client::with("roles")->findOrFail($id);
        $client = Client:: findOrFail($id);
        return $client;
    }
    public function show($id) {
        //
        $detailId = $id;
        $params = [
            'detailN' => $detailId
        ];
        return view('clients/detail', $params);
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
        return view('clients/edit', $params);

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
            $client = Client:: findOrFail($id);
            $client -> save();
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
                $client = Client:: findOrFail($id);
                if ($client -> img != null) {
                    Storage:: delete ('public/'.$client -> img);
                }
                $client -> delete ();
                return 1;
            } catch (\Illuminate\Database\QueryException $e) {
                return 0;
            }
        }
    }

}
