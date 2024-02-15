@extends('layouts.app')
@section('content')
<div class="compraFallido">
  No se ha podido hacer la compra de la entrada 
  <a href={{route('home')}}><button type="button" class="cerrarFeedbackFallido">
    <span aria-hidden="true">&times;</span>
    </button></a>
</div>
<script src="{{ asset('js/entradaFallido.js') }}"></script>
@endsection
