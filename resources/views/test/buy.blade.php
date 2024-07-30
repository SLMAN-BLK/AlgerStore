@extends('layouts.app')
<title>buy</title>
@section('content')
<div class="container mt-5">
    <div class="row">
        <style>
        .product-image {
            width: 300px;
            max-width: 600px;
            height: 300px;
        }
        </style>
        <!-- Image Section -->
        <div class="col-md-4" style="margin-left:100px;">
            <img src="{{ asset($item->image) }}" alt="Product Image" class="product-image">
        </div>
        <!-- Description Section -->
        <div class="col-md-6">
            <h1 class="product-title">{{ $item->title }}</h1>
            <p class="product-description">
            {{ $item->description }}
            </p>
            <p>Nom du vendeur: <a href="/magasin/{{$ven->id}}">{{ $ven->name }}</a></p>

            <p>nombre de produit vendu par ce vendeur : 
            @if( !empty($vendu))    
                {{ $vendu->nvendu }} 
            @else
                0
            @endif

            
            </p>
        </div>
    </div>
</div>
<div class="container mt-5">
    <form action="/ach/{{$item->id}}" method="post">
        @csrf
        <div class="form-group">
            <label for="tele">Telephone</label>
            <input type="text" class="form-control" name="tele" id="tele">
        </div>
        <div class="form-group">
            <label for="add">Address</label>
            <textarea class="form-control" name="address" id="add" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Acheter</button>
    </form>
</div>
@endsection
