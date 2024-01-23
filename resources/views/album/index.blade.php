@extends('layouts.base')
@section('body')
<div><a class="btn btn-primary " href="{{url('/song/create')}}" aria-disabled="true">create album</a></div>
<table class="table table-striped table-hover">
    @foreach($albums as $album)
    <tr>
        <td>{{$album->id}}</td>
        <td>{{$album->title}}</td>
        <td>{{$album->genre}}</td>
        <td>{{$album->date_released}}</td>
        <td><a href="{{route('album.edit', ['id' => $album->id])}}"><i class="fas fa-edit"></i></a></td>
        <td><a href="{{route('album.delete', ['id' => $album->id])}}"><i class="fas fa-trash" style="color:red"></i></a></td>
    </tr>
    @endforeach
    
</table>

{{$albums->links()}}
@endsection