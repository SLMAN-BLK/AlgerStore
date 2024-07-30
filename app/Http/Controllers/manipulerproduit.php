<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 



class manipulerproduit extends Controller
{
    public function valide($id){
        $newprice=request('newPrice');
        $a=DB::update('update items set price = :new where id = :id', ['new'=>$newprice,'id'=>$id]);
        $link = 'produit/' . Auth::user()->id;
        return redirect($link);

    }
    public function supprimer($id){
        $a=DB::delete('delete from items where id = ?', [$id]);
        $link = 'produit/' . Auth::user()->id;
        return redirect($link);
        


        
    }
}
