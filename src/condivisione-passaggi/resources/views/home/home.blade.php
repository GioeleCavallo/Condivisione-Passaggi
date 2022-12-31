@extends('layouts.master')
 
@section('title', 'Home page')
 
 
@section('content')
        <div>
            <form  id="form" method="POST" action="/logout">
                @csrf
                <a href="#" onclick="this.parentNode.submit();" class="link-success">Logout</a> |
                <a href="{{ url('/') }}/cars" class="link-success">Cars</a> 
                @if ($user->user_tipo == 'admin')
                | <a href="{{ url('/') }}/admin" class="link-success">Admin panel</a>
                
                @endif
            </form>
            

            <h1>Ciao, {{ $user->name }} {{ $user->cognome }}</h1>
            
            <p>Ecco alcune informazioni su di te:</p>

            <ul>
                <li>Email: {{ $user->email }}</li>
            </ul>
            <p>Cambia password: </p>
            <form  id="form" method="POST" action="/updatePassword">
                @csrf
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Old password" name="oldPassword">
                    <br>
                    <input type="password" class="form-control" id="floatingPassword" placeholder="New password" name="newPassword">
                </div><br><br>
                <button class="w-100 btn btn-primary btn-lg" type="submit">Cambia password</button>
            </form>
        </div>
        
@stop


