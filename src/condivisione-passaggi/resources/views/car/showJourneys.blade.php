@extends('layouts.master')
 
@section('title', 'Home page')
 
 
@section('content')
        <div>
            <form  id="form" method="POST" action="/logout">
                @csrf
                <a href="#" onclick="this.parentNode.submit();" class="link-success">Logout</a>
                | <a href="{{ url('/') }}/cars" class="link-success">Cars</a>
            </form>

            @if(count($journeys) != 0)
            <h1>I tuoi tragitti:</h1>
            <select name="journeys" id="journeys">
                @foreach ($journeys as $journey)
                    <option value="{{$journey->nome}}"><a href="url('/') }}/journey/{{$journey->id}}">{{$journey->nome}}</a></option>
                @endforeach
            </select>
            <a href="#" id="changeTragitto">modifica tragitto<a>
            <br><br>
            @endif
            <h1>Aggiungi un tragitto:</h1>

            <form  id="form" method="POST" action="/addJourney">
                @csrf
                
                <div class="form-floating">
                    <input type="hidden" id="targa" name="targa" value="{{$targa}}">
                    <input type="text" class="form-control" placeholder="Nome" name="nome" required><br>
                    <input type="text" class="form-control" placeholder="Descrizione" name="descrizione" required><br>
                    <br>
                    <input type="checkbox" id="lunedi" name="check_list[]" value="lunedi">
                    <label for="lunedi">lunedì</label><br>
                    <input type="checkbox" id="martedi" name="check_list[]" value="martedi">
                    <label for="martedi">martedI</label><br>
                    <input type="checkbox" id="mercoledi" name="check_list[]" value="mercoledi">
                    <label for="mercoledi">mercoledì</label><br>
                    <input type="checkbox" id="giovedi" name="check_list[]" value="giovedi">
                    <label for="giovedi">giovedì</label><br>
                    <input type="checkbox" id="venerdi" name="check_list[]" value="venerdi">
                    <label for="venerdi">venerdì</label><br>
                    <input type="checkbox" id="sabato" name="check_list[]" value="sabato">
                    <label for="sabato">sabato</label><br>
                    <input type="checkbox" id="domenica" name="check_list[]" value="domenica">
                    <label for="domenica">domenica</label><br>
                    <br>
                </div>
                <button class="w-100 btn btn-primary btn-lg" type="submit">Aggiungi tragitto</button>
            </form>
        </div>
        <script>
            function changeSelection()
            {
                $targa = $( "#cars option:selected" ).text();
                $("#changeAuto").attr("href", "{{url('/') }}/car/"+$targa);
            }

            $( "#cars" ).change(function() {
                changeSelection();
            });
            changeSelection();
            
        </script>
@stop