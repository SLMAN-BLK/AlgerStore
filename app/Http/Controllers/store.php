<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

class store extends Controller
{
    public function index($id){
        $perr = DB::select('SELECT * FROM items WHERE idven = :idd', ['idd' => $id]);  

        return view('test.magasin',['per'=>$perr,'nomven'=>$id]);


    }
}
