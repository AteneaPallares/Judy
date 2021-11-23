<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    //
    
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function actual() {
        $user = auth() -> user();
        $user -> roles;
        return $user;
    }
    public function index() {
        //

        return view('users.index');
    }

    public function showall() {
        //return User::with('roles','schedule')->get();
        return User:: with ('role') -> get();
        //return User::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('users.create');
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
            $user = User:: findOrFail($request -> deleteImage);
            if ($user -> img != null) {
                Storage:: delete ('public/'.$user -> img);
            }
            $user -> img=null;
            $user -> save();
            return 1;
        }
        if ($request -> editImage != NULL) {
            if ($request -> hasFile('imagen')) {
                $user = User:: findOrFail($request -> editImage);
                Storage:: delete ('public/empleados/'.$user -> img);
                $stri = "empleado".($user -> id).'.'.$request -> file('imagen') -> extension();;
                $path = $request -> imagen -> storeAs('empleados', $stri, 'public');
                $user -> img=$path;
                DB:: beginTransaction();
                DB:: commit();
                $user -> save();
                return 7;
            }
            return 3;
        }
        try {
            try {
                $validator = Validator:: make($request -> all(), [
                    'name' => 'required|max:255|regex:/^[\pL\s]+$/u',
                    'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
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
                $new = User:: findOrFail($request -> id);
            } else {

                $new = new User();
            }
            $new -> name=$request -> name;
            $new -> email=$request -> email;
            $findid = User:: select("*")
                -> where("email", "=", $request -> email) -> first();
            if ($findid != null && $findid -> id != $new -> id) {
                return ['response'=> 'El correo ya ha sido utilizado'];
            }
            if ($request -> password != null) {
                $new -> password=Hash:: make($request -> password);
            }
            $new -> address=$request -> address;
            $new -> birthdate=$request -> birthdate;
            $new -> phone=$request -> phone;
            $new -> gender=$request -> gender;
            $new -> status=$request -> status;
            $new -> id_role=$request -> role;
            if ($request -> hasFile('imagen')) {
                $stri = "empleado".($user -> id).'.'.$request -> file('imagen') -> extension();;
                $path = $request -> imagen -> storeAs('empleados', $stri, 'public');
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
        //$user=User::with("roles")->findOrFail($id);
        $user = User:: findOrFail($id);
        return $user;
    }
    public function show($id) {
        //
        $detailId = $id;
        $params = [
            'detailN' => $detailId
        ];
        return view('users/detail', $params);
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
        return view('users/edit', $params);

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
            $user = User:: findOrFail($id);
            $user -> save();
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
                $user = User:: findOrFail($id);
                if ($user -> img != null) {
                    Storage:: delete ('public/'.$user -> img);
                }
                $user -> delete ();
                return 1;
            } catch (\Illuminate\Database\QueryException $e) {
                return 0;
            }
        }
    }

}
