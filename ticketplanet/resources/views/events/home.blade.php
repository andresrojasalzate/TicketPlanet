@extends('layouts.app')

@section('title', "Home") 

@section('content')

    <div class="layout-home">
      <x-buscador/>
      @foreach ($categories as $category)
        <x-mostrar-categoria-component :nombreCategoria="$category->name" :events="$category->events"/>
      @endforeach
    </div>

@endsection