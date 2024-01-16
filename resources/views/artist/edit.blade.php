@extends('layouts.base')

@section('body')
{{-- {{dd($artist)}} --}}
    <form action="{{url('/artist/'.$artist->id.'/update')}}" method="POST">
        @csrf
        
        <input type="text" name="name" value="{{$artist->name}}" >
        <input type="text" name="country" value="{{$artist->country}}">
        <input type="text" name="image" value="{{$artist->img_path}}">
        <input type="submit" >
    </form>
@endsection