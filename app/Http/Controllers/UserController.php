<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function actual(){
        $user=auth()->user();
        $user->roles;
        return $user;
    }
    public function index()
    {
        //
        
        return view('users.index');
    }

    public function showall()
    {
        //return User::with('roles','schedule')->get();
        return User::with('role')->get();
        //return User::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
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
        if ($request -> deleteImage != NULL) {
            $user = User:: findOrFail($request -> deleteImage);
            if ($user -> image != null) {
                Storage:: delete ('public/'.$user -> image);
            }
            $user -> image=null;
            $user -> save();
            return 1;
        }
        if ($request -> editImage != NULL) {
            if ($request -> hasFile('imagen')) {
                $user = User:: findOrFail($request -> editImage);
                Storage:: delete ('public/'.$user -> image);
                $path = Storage::putFile('public', $request->file('imagen'));
                $ur = (string)$request -> imagen -> hashName();;
                $user -> image=$ur;
                DB::beginTransaction();
                DB::commit();
                $user -> save();
                return 7;
            }
            return 3;
        }
        try{
            $edit=false;
            $new=[];
            if($request->id!=null){
                
                $edit=true;
                $new = User:: findOrFail($request -> id);
            }else{
                
                $new=new User();
            }
            $new->name=$request->name;
            $new->email=$request->email;
            $findid=User::select("*")
                ->where("email", "=",$request->email)->first();
            if($findid!=null && $findid->id!=$new->id){
                return ['response'=>'El correo ya ha sido utilizado'];
            }
            if($request->password!=null){
                $new->password=Hash::make($request->password);
            }
            $new->address=$request->address;
            $new->birth_date=$request->birth_date;
            $new->phone=$request->phone;
            //$new->ns=$request->ns;
            //$new->CURP=$request->CURP;
            //$new->gender=$request->gender;
            //$new->occupation=$request->occupation;
            //$new->marita_status=$request->marita_status;
            //$new->weight=$request->weight;
            //$new->height=$request->height;
            
            //$new->phone_sec=$request->phone_sec;
           // $new->status=$request->status;
           // $new->cetificate_number=$request->cetificate_number;
            //$new->salary=$request->salary;
            
            if ($request -> hasFile('imagen')) {
                $path = $request -> imagen -> store('public');
                $ur = (string)$request -> imagen -> hashName();;
                $new-> image=$ur;
            }
            DB::delete('delete from role_user where user_id = ?',[$new->id]);
            $new->save();
            $new->roles()->attach($request->role);
           
            return ['response'=>$new->id];
        }catch(\Exception $e){
            return ['response'=>$e];
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showone($id){
        //$user=User::with("roles")->findOrFail($id);
        $user=User::findOrFail($id);
        return $user;
    }
    public function show($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('users/detail',$params);
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
    public function showedit($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('users/edit',$params);

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
        try{
            $user = User:: findOrFail($id);
            //$user->id_schedule=$request->id_schedule;
            $user -> save();
        }catch(\Illuminate\Database\QueryException $e){
            return $e;
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
        //
        if(request()->isMethod("DELETE")){
            try{
                $user=User::findOrFail($id);
                if ($user -> image != null) {
                    Storage:: delete ('public/'.$user -> image);
                }
                $user->delete();
                return 1;
            }catch(\Illuminate\Database\QueryException $e){
                return 0;
            }
            
        }
    }

}
