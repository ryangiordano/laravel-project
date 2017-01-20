@extends('layouts.master')

@section('content')
<h1>I greet {{$name === null ? 'you' : $name}}</h1>
@endsection
