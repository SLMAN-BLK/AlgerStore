@extends('layouts.app')
<title>magasin {{ $nomven }}</title>
@section('content')

    
<div class="container mt-4">
        <div class="row g-3">
    @foreach ($per as $i )
        <div class="col-12 col-sm-7 col-md-5 col-lg-3" onclick="window.location.href='/buy/{{$i->id}}'">
                <div class="card" style="width: 100%;">
                    <img src="{{asset($i->image)}}" class="card-img-top" alt="Product Image" style='width=300px;height=400px'>
                    <div class="card-body">
                        <h5 class="card-title">{{$i->title}}</h5>
                        <p class="card-text">{{$i->price}} DA</p>
                    </div>
                </div>
            </div>
    @endforeach
  
            
        </div>
    </div>

 @endsection

