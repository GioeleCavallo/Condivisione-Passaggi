@extends('layouts.master')
 
@section('title', 'Login')
 
 
@section('content')
        <div>
            <h1>THI IS LOGIN</h1>
            <form  id="form" method="POST" action="/checkLogin">
            @csrf
                <h1 class="mb-3 fw-normal">Login</h1>
            
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="email" name="email" >
                    
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">

                </div>
            
                <button class="w-100 btn btn-primary btn-lg" type="submit">Login</button>
                
            </form>
        </div>
        
@stop


