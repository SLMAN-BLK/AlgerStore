@extends('layouts.app')

@section('content')
    


    <link rel="stylesheet" href="/css/vendre.css">  
    <style>

    img{
        height:50px;
        width: 50px;
        
    }
</style>   
    <div class="container mt-5">
    <table class="table table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">titre</th>
          <th scope="col">prix en DA</th> 
          <th scope="col">description</th>
          <th scope="col">image</th>
          <th scope="col">changer le prix</th>
          <th scope="col">supprimer</th>
        </tr>
      </thead>
      <tbody>
      @foreach($per as $i)
      <tr>
          <td>{{$i->title}}</td>
          <td id="{{ $i->id }}">{{$i->price}}</td>
          <td>{{$i->description}}</td>
          <td><img src="{{ asset($i->image) }}" alt="makan walou"></td>
          <td><button type="button" onclick="change({{$i->id}}, {{$i->id}});" class="btn btn-primary btn-sm">changer le prix</button></td>
          <td><button onclick="supp({{$i->id}});"class="btn btn-primary btn-sm">supprimer</button></td>
          
        </tr>
  @endforeach


  
  <script src="../js/produit.js"></script>


    <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>
   


 @endsection
