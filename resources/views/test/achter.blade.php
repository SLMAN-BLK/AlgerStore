@extends('layouts.app')
<title>Store</title>
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/achter.css">
    <title>achter</title>
</head>
<body>
    <style>

        .col-12:hover{
            cursor: pointer;
        }
    </style>
<div class="container mt-4">
        <div class="row g-3">
    @foreach ($pro as $i )

   
    
        <div class="col-12 col-sm-7 col-md-5 col-lg-3" onclick="window.location.href='/buy/{{$i->id}}'">
                <div class="card" style="width: 100%;">
                    <img src="{{$i->image}}" class="card-img-top" alt="Product Image" style='width=300px;height=400px'>
                    <div class="card-body">
                        <h5 class="card-title">{{$i->title}}</h5>
                        <p class="card-text">{{$i->price}} DA</p>
                    </div>
                </div>
            </div>
    @endforeach
  
            
        </div>
    </div>
</body>
</html>

 @endsection

