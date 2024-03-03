@extends('layouts.app')
@section('title', 'Entrada')
@section('meta_description', 'Compra realizada con éxito')
@section('content')
<div class="contenedorcompraFeedback">
  <div class="compraExito">
    La compra de la entrada se ha realizado con exito
    <a href={{route('home')}}><button type="button" class="cerrarFeedbackSuccess">
      <span aria-hidden="true">&times;</span>
      </button></a>
  </div>
</div>

<script src="{{ asset('js/entradaSuccess.js') }}"></script>
@endsection

