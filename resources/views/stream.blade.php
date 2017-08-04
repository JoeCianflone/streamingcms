@extends('master')

@section('page_title', 'Hello')

@section('content')

   <h1>something?</h1>
   @foreach($content->items() as $item)
      @includeif('streams.'.$item['type'], $item)
   @endforeach

@endsection
