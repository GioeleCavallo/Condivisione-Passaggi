@extends('layouts.master')
 
@section('title', 'Home page')
 
 
@section('content')
        <div>
            <form  id="form" method="POST" action="/logout">
                @csrf
                <a href="#" onclick="this.parentNode.submit();" class="link-success">Logout</a>
            </form>
            <a href="{{ url('/') }}/cars" class="link-success">Cars</a>
            <h1>{{ $user->email }}, aggiungi un'auto:</h1>

            
            <form  id="form" method="POST" action="/addCar">
                @csrf
                
                <div class="form-floating">
                    <input type="text" class="form-control" placeholder="Targa" name="targa" required>
                    <br>
                    <input type="text" class="form-control" placeholder="Marca" name="marca" required>

                    <label for="color_car">Colore:</label>
                    <input type="color" class="form-control" name="color_car" required>
                    <br>
                    <label for="posti">Posti:</label>
                    <input type="number" class="form-control" name="posti" required>
                    <br>
                </div>
                <button class="w-100 btn btn-primary btn-lg" type="submit">Aggiungi auto</button>
            </form>
        </div>
        
@stop


