@extends('layouts.master')
 
@section('title', 'Login')
 
 
@section('content')
        <div>
            <form  id="form" method="POST" action="/checkLogin">
            @csrf
                <h1 class="mb-3 fw-normal">Login</h1>
            
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="email" name="email" required>
                    
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>

                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="remember" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember me</label>
                </div>
                <button class="w-100 btn btn-primary btn-lg" type="submit">Login</button>
                <br>
                <br>
                <h1>
                Questo progetto aiuterà i genitori a trovare un modo per organizzare il passaggio dei propri figli per il tempo libero e non. In questo modo si potrà ottimizzare il tempo condividendo i passaggi e i posti in auto, in più si avrà un impatto positivo per l’ambiente.
                </h1>
            </form>
        </div>
        
@stop


