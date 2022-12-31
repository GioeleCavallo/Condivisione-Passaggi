@extends('layouts.master')
 
@section('title', 'Home page')
 
 
@section('content')
        <div>
            <form  id="form" method="POST" action="/logout">
                @csrf
                <a href="#" onclick="this.parentNode.submit();" class="link-success">Logout</a>
                | <a href="{{ url('/') }}/cars" class="link-success">Cars</a>
            </form>
            
            <form  id="form" method="POST" action="/updateCar">
                @csrf
                
                <div class="form-floating">
                    <label for="targa">Targa:</label>
                    <input type="text" class="form-control" placeholder="Targa" name="targa" value="{{$car->targa}}" required disabled>
                    <br>
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" placeholder="Marca" name="marca" value="{{$car->marca}}" required>
                    <br>
                    <label for="color_car">Colore:</label>
                    <label for="color_car">Colore:</label>
                    <input type="color" class="form-control" name="color_car" value="{{$car->colore}}" required>
                    <br>
                    <label for="posti">Posti:</label>
                    <label for="posti">Posti:</label>
                    <input type="number" class="form-control" name="posti" value="{{$car->posti}}" required>
                    <br>
                </div>
                <button class="w-100 btn btn-primary btn-lg" type="submit">Aggiorna auto</button>
            </form>
        </div>
        
@stop


