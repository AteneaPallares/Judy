<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Iva;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Models\Supplier;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard/index');
    }
    public function print(){
        $params=$this->showall();
        view()->share('all',$params);
        //view()->share('assigned_schedules/edit',$params);
         $pdf = PDF::loadView('dashboard/print', $params);

         // download PDF file with download method
         return $pdf->download('reporte.pdf');
    
    }
    public function showall()
    {
        $obj=new \stdClass();
        $obj->client=count(Client::all());
        $obj->user=count(User::all());
        $obj->iva=count(Iva::all());
        $obj->product=count(Product::all());
        $obj->sale=count(Sale::all());
        $obj->order=count(Order::all());
        $obj->supplier=count(Supplier::all());
        $userinfo=[];
        $help=1;
        $array = array(0 => 'azul');
        $users= User::with('role')->get();
        foreach($users as $element){
            if($element->role!=null){
                $key = array_search($element->role->name, $array); 
                if($key==false && $element->role!=null){
                        $userinfo[$element->role->name]=1;
                        array_push($array,$element->role->name);
                }else if($element->role!=null){
                        $help= $userinfo[$element->role->name]+1;
                        $userinfo[$element->role->name]=$help;
                }
            }
        }
        $usersall=User::all();
        $usersd=[];
        $help=1;
        $array = array(0 => 'azul');
        foreach($usersall as $element){
            $key = array_search($element->status, $array); // $clave = 2;
               
           if($key==false && $element->status!=null){
                $usersd[$element->status]=1;
                array_push($array,$element->status);
           }else if($element->status!=null){
                $help= $usersd[$element->status]+1;
                $usersd[$element->status]=$help;
           }
           
        }
        $numberdate=[];
        $record=Sale::all();
        for($x=0;$x<=7;$x++){
            $record=Sale::all();
            $contdate=0;
            $past=Carbon::today()->subDays(7-$x);
            foreach($record as $element){
                $date=new \DateTime($element->updated_at);
                $comp=Carbon::instance($date);
                if($comp->day==$past->day && $comp->month==$past->month && $comp->year==$past->year){
                    $contdate+=1;
                }
            }
            array_push($numberdate,['date'=>$past,'num'=>$contdate]);  
        }
        $numberdate2=[];
        $record=Order::all();
        for($x=0;$x<=7;$x++){
            $record=Order::all();
            $contdate=0;
            $past=Carbon::today()->subDays(7-$x);
            foreach($record as $element){
                $date=new \DateTime($element->updated_at);
                $comp=Carbon::instance($date);
                if($comp->day==$past->day && $comp->month==$past->month && $comp->year==$past->year){
                    $contdate+=1;
                }
            }
            array_push($numberdate2,['date'=>$past,'num'=>$contdate]);  
        }
        $data = ['all'=>$obj,'users'=>$userinfo,'usersd'=> $usersd,'register'=>$numberdate,'register2'=>$numberdate2];
       
        
        return $data;
    }
    public function create() {
       
    }
    public function store(Request $request) {
        

    }
    public function show(int $id,Request $request) {
        
    }

    public function edit(UsersCdu $usersCdu, $id) {
       
    }
    public function destroy(int $id) {
        
    }
}
