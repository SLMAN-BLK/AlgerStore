<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;

class produit extends Controller
{
    public  function index($id){

        $per = DB::select('SELECT * FROM items WHERE idven = :id', ['id' => Auth::user()->id]);
        return view('test.produit',['per'=>$per]);
        
        

    }
}
