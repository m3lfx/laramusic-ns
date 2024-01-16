@extends('layouts.base')
@section('body')
<table class="table table-striped table-hover">
    @foreach($artists as $artist)
    <tr>
        <td>{{$artist->id}}</td>
        <td>{{$artist->name}}</td>
        <td>{{$artist->country}}</td>
        <td>{{$artist->img_path}}</td>
        <td><a href="{{url('/artist/'. $artist->id.'/edit')}}"><i class="fas fa-edit"></i></a></td>
        <td><a href="{{url('/artist/'. $artist->id.'/delete')}}"><i class="fas fa-trash" style="color:red"></i></a></td>
    </tr>
    @endforeach
    
</table>
@endsection