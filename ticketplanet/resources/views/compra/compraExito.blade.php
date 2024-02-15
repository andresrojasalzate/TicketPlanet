@extends('layouts.app')
@section('title', 'Entrada')
@section('content')
<div class="compraExito">
  La compra de la entrada se ha realizado con exito
  <a href={{route('home')}}><button type="button" class="cerrarFeedbackSuccess">
    <span aria-hidden="true">&times;</span>
    </button></a>
</div>
<script src="{{ asset('js/entradaSuccess.js') }}"></script>
@endsection

