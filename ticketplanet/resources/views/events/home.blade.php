@extends('layouts.app')

@section('title', "Home") 

@section('content')

    <div class="layout-home">
      <x-buscador :categories="$categories"/>
      @foreach ($categories as $category)
        <x-mostrar-categoria-component :nombreCategoria="$category->name" :events="$category->events" :categoryId="$category->id"/>
      @endforeach
    </div>
    <script src="{{ asset('js/home.js') }}"></script>
@endsection