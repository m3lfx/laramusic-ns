@extends('layouts.base')
@section('body')
    <div><a class="btn btn-primary " href="{{ route('listeners.create') }}" aria-disabled="true">create listeners</a></div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">image</th>
                <th scope="col">name</th>
                <th scope="col">address</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listeners as $listener)
                <tr>
                    <td>{{ $listener->id }}</td>
                    @if ($listener->img_path)
                        <td><img src="{{ url($listener->img_path) }}" alt="listener image" width="50" height="50">
                        </td>
                    @else
                        <td><img src="#" alt="listener image" width="50" height="50">
                        </td>
                    @endif

                    <td>{{ $listener->name }}</td>
                    <td>{{ $listener->address }}</td>

                    @if ($listener->deleted_at === null)
                        <td><a href="{{ route('listeners.edit', $listener->id) }}"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('listeners.destroy', $listener->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button><i class="fas fa-trash" style="color:red"></i></button>
                            </form>
                            <i class="fa-solid fa-rotate-left" style="color:gray"></i>
                        </td>
                    @else
                        <td><i class="fas fa-edit" style="color:gray"></i>
                            <i class="fas fa-trash" style="color:gray"></i>
                            <a href="{{ route('listeners.restore', $listener->id) }}"><i class="fa-solid fa-rotate-left"
                                    style="color:blue"></i></a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>

    </table>

    {{-- {{ $listeners->links() }} --}}
@endsection
