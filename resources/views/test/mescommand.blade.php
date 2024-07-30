@extends('layouts.app')

@section('content')
    


    <link rel="stylesheet" href="/css/vendre.css">     
    <div class="container mt-5">
    <table class="table table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Nom Acheteur</th>
          <th scope="col">Nom Produit</th> 
          <th scope="col">Téléphone</th>
          <th scope="col">Adresse</th>
          <th scope="col">etat</th>
        </tr>
      </thead>
      <tbody>
        @if (empty($per))
        <h1>makan walou</h1>
        @endif
        
      @foreach($per as $i)
      <tr>
          <td>{{ $i->nomach }}</td>
          <td>{{ $i->nompro }}</td>
          <td>{{ $i->tele }}</td>
          <td>{{ $i->address }}</td>
          <td>
          @if(Auth::user()->type=="acheteur")
              @if ( $i->etat=="demande")
                  <form action="/mescommand/{{ $i->id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">Confirmer La Reception</button></form>
                  
              @else
                  {{ $i->etat }}

              @endif
          @else
              @if ( $i->etat=="demande")
                     {{ $i->etat }}
              @else
                     {{ $i->etat }}

              @endif

          @endif 
            </td> 
        </tr>
    @endforeach

      
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>
   


 @endsection
