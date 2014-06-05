@extends('layout')

@section('content')
    This is a homepage!

    @foreach($users as $user)
        <p>{{ $user->name }}</p>
    @endforeach

@stop