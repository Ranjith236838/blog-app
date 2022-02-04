@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col justify-content-between">
                <img src="/storage/{{ $post->image }}" height="400">
                
               
            </div>
        </div>

        <div class="row p-3">
            <strong>{{ $post->title }}</strong>
        </div>

        <div class="row p-3">
            <p> {{ $post->content }} </p>
        </div>
</div>
@endsection