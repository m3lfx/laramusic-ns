@extends('layouts.base')

@section('body')
    <form action="{{url('/artist/store')}}" method="POST">
        @csrf
        
        <input type="text" name="name" >
        <input type="text" name="country">
        <input type="text" name="image">
        <input type="submit" >
    </form>
@endsection