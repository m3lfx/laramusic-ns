@extends('layouts.base')
@section('body')
    <div><a class="btn btn-primary " href="{{ url('/songs/create') }}" aria-disabled="true">create songs</a></div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">song id</th>
                <th scope="col">song name</th>
                <th scope="col">description</th>
                <th scope="col">album title</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($songs as $songs)
                <tr>
                    <td>{{ $songs->id }}</td>
                    <td>{{ $songs->song_name }}</td>
                    <td>{{ $songs->description }}</td>
                    <td>{{ $songs->album_title }}</td>
                    {{-- <td><a href="{{route('songs.edit', ['id' => $songs->id])}}"><i class="fas fa-edit"></i></a></td>
        <td><a href="{{route('songs.delete', ['id' => $songs->id])}}"><i class="fas fa-trash" style="color:red"></i></a></td> --}}
                </tr>
            @endforeach
        </tbody>

    </table>

    {{-- {{$songss->links()}} --}}
@endsection
