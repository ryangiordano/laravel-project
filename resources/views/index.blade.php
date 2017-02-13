@extends('layouts.master')

@section('title')
Trending Quotes
@endsection

@section('styles')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
  @if (!empty(Request::segment(1)))
    <section class="filter-bar">A filter has been set. <a href="{{route('index')}}">Show all quotes</a></section>
  @endif
  @if (count($errors)>0)
<section class="info-box fail">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>

</section>
  @endif
  @if (Session::has('success'))
    <section class="">
      {{Session::get('success')}}
    </section>
  @endif
<section class="quotes">
  <div class="container">

    <div class="row">
          <h1>Latest Quotes</h1>
          @if ($quotes->currentPage()!==1)
            <a href="{{$quotes->previousPageUrl()}}"><span class="fa fa-caret-left"></span></a>

          @endif
          @if ($quotes->currentPage()!== $quotes->lastPage() && $quotes->hasPages())
                        <a href="{{$quotes->nextPageUrl()}}"><span class="fa fa-caret-left"></span></a>
          @endif
          @foreach ($quotes as $quote)

            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="info">Created By <a href="{{route('index',['author'=>$quote->author->name])}}">{{$quote->author->name}}</a> on {{$quote->created_at}}</div>
                  <div class="delete"><a href="{{route('delete',['quote_id'=>$quote->id])}}">x</a></div>
                </div>
                <div class="panel-body">
                  <article class="quote">
                        {{$quote->quote}}
                  </article>
                </div>
              </div>
            </div>
          @endforeach

    </div>
  </div>



</section>
<section class="edit-quote">
  <div class="container">
    <div class="row">
              <h1>Add a Quote</h1>
      <div class="col-md-4">
        <form class="form-horizontal" action="{{ route('create') }}" method="post">
          <fieldset>
          <div class="form-group">
            <label for="" class="control-label">Your Name</label>
            <input class="form-control"type="text" name="author" id="author" value="" placeholder="Enter your name">
            <label for="" class="control-label">Your Email</label>
            <input class="form-control"type="text" name="email" id="email" value="" placeholder="Enter your name">
            <label for="" class="control-label">Your Quote</label>
            <textarea type="text" class="form-control" name="quote" id="quote" value="" rows="5" placeholder="Enter your Quote"></textarea>

            <input type="text" hidden name="_token" value="{{Session::token()}}">
          </div>
          <div class="form-group">
            <div class="col-lg-10 ">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
          </fieldset>

        </form>
      </div>
    </div>
  </div>

</section>
@endsection
