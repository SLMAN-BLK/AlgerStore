@extends('layouts.app')

@section('content')
<!--ici le code Html normal -->
<style>

     /* Ensure the image covers the entire viewport height */
     .full-screen-image {
            position: relative;
            width: 100%;
            height: 100vh; /* Full viewport height */
            object-fit: cover; /* Cover the container */
        }
        /* Make sure the body takes full height */
        html, body {
            height: 100%;
            margin: 0;
        }
        /* Margin for the navbar */
        .navbar-fixed {
            margin-bottom: 0; /* Remove margin to avoid gaps */
        }
        main{
            padding: 0;
        }
</style>
<div class="container-fluid p-0">
        <img src="images/welcom.jpg" alt="Full Screen Image" class="full-screen-image">
    </div>
    
 @endsection