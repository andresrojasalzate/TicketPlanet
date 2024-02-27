@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <div class="layout-home">
        <x-buscador :categories="$categories" />

        @if ($categories != null && !$categories->isEmpty())

            @foreach ($categories as $category)
                <x-mostrar-categoria-component :nombreCategoria="$category->name" :events="$category->events()->eventosLimitados()->eventosVisibles()->get()" :categoryId="$category->id" />
            @endforeach
        @else
            <div class="eventos-no-encontrados">
                <p>No se han encotrado eventos</p>
            </div>
        @endif
        
    </div>
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
