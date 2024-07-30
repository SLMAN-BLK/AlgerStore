<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class achteur extends Controller
{
    public function index(){
        $per = DB::select('SELECT * FROM items');
        return view('test.achter',['pro'=>$per]);

    }
}
