@extends('layouts.base')
@section('body')
    <div><a class="btn btn-primary " href="{{ route('songs.create') }}" aria-disabled="true">create songs</a></div>
    <div class="container">
        {!! Form::open( ['route' => ['songs.search'], 'class' => 'form-control' ]) !!}
       
        {!! Form::text('search', ) !!}
        
        {!! Form::submit('submit', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
    
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
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->id }}</td>
                    <td>{{ $result->title }}</td>
                    <td>{{ $result->description }}</td>
                    {{-- <td>{{ $song->album_title }}</td> --}}
                    <td><a href="{{ route('songs.edit', ['song' => $result->id]) }}"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <form action="{{ route('songs.destroy', $result->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            
                            <button><i class="fas fa-trash"
                                style="color:red"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{-- {{ $songs->links() }} --}}
@endsection
