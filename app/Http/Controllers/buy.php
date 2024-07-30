<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 



class buy extends Controller
{
    public function index($id){
        $perr = DB::select('SELECT * FROM items WHERE id = :idd', ['idd' => $id]);   
        $per=$perr[0];
        $ven=DB::select('SELECT * FROM users WHERE id = :idd', ['idd' => $per->idven]); 
        $ven=$ven[0];
        $vendu=DB::select('select * from vendu  where idven = ?', [$per->idven]);
            if(!empty($vendu)){
                    $vendu=$vendu[0];
                }
            
        return view('test.buy',['item'=>$per,"ven"=>$ven,"vendu"=>$vendu,"nvendu"=>"zero"]);
  
    }
  
    
    public function mescommand()
    {
    $commands = [];
    if (Auth::user()->type == "vendeur") {
        $commands = DB::select('SELECT * FROM command WHERE idven = :idd', ['idd' => Auth::user()->id]);
    } else {
        $commands = DB::select('SELECT * FROM command WHERE nomach = :idd', ['idd' => Auth::user()->name]);
    }

    // If no commands are found, initialize $commands to an empty array
    if (empty($commands)) {
        $commands = [];
    }

    // Return the view with the commands data
    return view('test.mescommand', ['per' => $commands]);
    }
    
    public function mescommandpost($id){
  
        $perr = DB::update('update command set etat="recu" where id=:idd', ['idd' => $id]);
        $command=DB::select('select * from command where id = ?', [$id]);
        $command=$command[0];
        $vendu=DB::select('select * from vendu where idven= ?', [$command->idven]);
        if(empty($vendu)){
            
            $insert = DB::insert('insert into vendu (idven, nvendu) values (?, ?)', [$command->idven, 1]);

        }
        else{
            
            $insert = DB::update('update vendu set nvendu = nvendu+1 where idven = ?', [$command->idven]);
        }

        return redirect('/mescommand');
    //lazem return hnaa
    }
    
}
   