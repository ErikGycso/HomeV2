@extends('layouts.app')

@section('content')

<div id="app" class="content"><!--La equita id debe ser app, como hemos visto en app.js-->
    <App></App><!--Añadimos nuestro componente vuejs-->
</div>
<script src="{{asset('js/app.js')}}?v=2"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->
@endsection