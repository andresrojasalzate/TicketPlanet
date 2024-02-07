@extends('layouts.app')

@section('title', 'Home')

@section('content')

@if(Session::has('success'))
<div class="alert-success" id="success-alert">
{{ Session::get('success') }}
        <button type="button" class="cerrarFeedback">
<span aria-hidden="true">&times;</span>
</button>
@endif

</div>

    <div class="layout-home">
        <x-buscador :categories="$categories" />

        @if ($categories != null && !$categories->isEmpty())

            @foreach ($categories as $category)
                <x-mostrar-categoria-component :nombreCategoria="$category->name" :events="$category->events" :categoryId="$category->id" />
            @endforeach
        @else
            <div class="eventos-no-encontrados">
                <p>No se han encotrado eventos</p>
            </div>
        @endif
        
    </div>
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
