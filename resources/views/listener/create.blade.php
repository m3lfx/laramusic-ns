@extends('layouts.base')

@section('body')
    <div class="container">
        {!! Form::open(['url' => 'listeners']) !!}
        {{ Form::label('last_name', 'Last Name', ['class' => 'form-control']) }}
        {!! Form::text('last_name') !!}
        {{ Form::label('first_name', 'first Name', ['class' => 'form-control']) }}
        {!! Form::text('first_name') !!}
        {{ Form::label('address', 'Address', ['class' => 'form-control']) }}
        {!! Form::text('address') !!}
        {{ Form::label('img_path', 'upload image', ['class' => 'form-control']) }}
        {!! Form::file('img_path', ['class' => 'form-control']) !!}
        {!! Form::close() !!}
    </div>
@endsection
