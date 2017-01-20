@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      @foreach($actions as $action)
        <li><a href="{{route('niceaction',['action'=>lcfirst($action->name)])}}">{{$action->name}}</a></li>
      @endforeach
      {{-- <a href="{{route('niceaction',['action'=>'greet'])}}">Greet</a>
      <a href="{{route('niceaction',['action'=>'hug'])}}">Hug</a>
      <a href="{{route('niceaction',['action'=>'kiss'])}}">Kiss</a> --}}
    </div>
    <div class="col-md-6">
      <form class="form-group" action="{{route('home')}}" method="post">
        <label for="select">Select an Action</label>

        <br>
        <label for="name">Name of Action</label>
        <input type="text" class="form-control" name="name" >
        <label for="name">Niceness</label>

        <input type="number" class="form-control" name="niceness" >
        <br>
        <button type="submit" name="button" class="btn btn-primary">Submit</button>
        <input type="hidden" name="_token" value="{{Session::token()}}">
      </form>
      @if(count($errors)>0)
          <div>
            <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
      @endif
    </div>
  </div>
</div>
@endsection
