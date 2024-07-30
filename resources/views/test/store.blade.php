@extends('layouts.app')

@section('content')
    
@if( Auth::user()->type == 'vendeur')

    <link rel="stylesheet" href="/css/vendre.css">

        <div class="par">
            <div class="fils" onclick="window.location.href='/vendre'"><p>vendre</p></div>
            <div class="fils" onclick="window.location.href='/produit/{{Auth::user()->id}}'"><p>mes produit</p></div>
            <div class="fils" onclick="window.location.href='/mescommand'"><p>mes command</p></div>
       </div>

   

    @endif

 @endsection

    
 