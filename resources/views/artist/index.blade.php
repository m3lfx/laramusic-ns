@extends('layouts.base')
@section('body')
<table>
    @foreach($artists as $artist)
    <tr>
        <td>{{$artist->id}}</td>
        <td>{{$artist->name}}</td>
        <td>{{$artist->country}}</td>
        <td>{{$artist->img_path}}</td>
    </tr>
    @endforeach
    
</table>
@endsection