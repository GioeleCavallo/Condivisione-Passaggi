@extends('layouts.master')
 
@section('title', 'Home page')
 
 
@section('content')
        <div>
            <form  id="form" method="POST" action="/logout">
                @csrf
                <a href="#" onclick="this.parentNode.submit();" class="link-success">Logout</a>
            </form>
             
            <p>Aggiungi un utente: </p>
            <form  id="form" method="POST" action="/addUser">
                @csrf
             
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Name" name="name" required><br>
                    <input type="email" class="form-control" id="floatingEmail" placeholder="Email" name="email" required><br>
                    <label for="tipo">User type</label>
                    <select name="tipo">
                    @foreach ($tipi as $tipo)
                        <option value="{{$tipo->nome}}">{{$tipo->nome}}</option>
                    @endforeach
                    </select>
                    <br>
                </div>
                <button class="w-100 btn btn-primary btn-lg" type="submit">Aggiungi utente</button>
            </form>
        </div>
        
@stop


