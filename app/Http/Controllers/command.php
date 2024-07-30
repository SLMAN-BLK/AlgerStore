<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ordermail; // Ensure correct namespace for your Mailable

class Command extends Controller
{
    public function index($id)
    {
        $tel = request('tele');
        $address = request('address');
        $items= DB::select('select * from items where id=:leid', ['leid' => $id]);
        // Insert command
        $item=$items[0];
        $inserted = DB::insert('INSERT INTO command (tele, address, nomach, nompro,idven,etat) VALUES (:tel, :address, :nomach, :nompro,:idven,:etat)', [
            'tel' => $tel,
            'address' => $address,
            'nomach' => Auth::user()->name,
            'nompro' => $item->title,
            'idven'=> $item->idven,
            'etat'=>'demande'

        ]);
        
        // Fetch item and vendor
        $per = DB::select('SELECT * FROM items WHERE id = :id', ['id' => $id]);
        if (!empty($per)) {
            $p = $per[0];

            $vendeur = DB::select('SELECT * FROM users WHERE id = :id', ['id' => $p->idven]);
            if (!empty($vendeur)) {
                $v = $vendeur[0];
                
                // Create and populate the order object
                $order = new \stdClass();
                $order->tel = $tel;
                $order->address = $address;
                $order->nomachteur = Auth::user()->name;
                $order->title = $p->title;

                // Send email
                Mail::to($v->email)->send(new OrderMail($order));
                
                // Return view
                return view('test.valide');
            } else {
                return response()->json(['error' => 'Vendor not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Item not found'], 404);
        }
    }
}
