@extends('layouts.base')

@section('head')
    @parent
    <link rel="stylesheet" href="another.css" />
@stop


@section('body')
    {{-- {{dd($artists)}} --}}
    @foreach ($artists as $artist)
        <h2>{{ $artist->name }}</h2>
        <p>{{ $artist->country }}</p>
    @endforeach
@stop
