@extends('layouts.app')


@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row pt-6 pb-4">
        <div class="col-4 offset-3">
            <a href="/profile/{{ $post ->user->id }}"><img src="/storage/{{ $post->image }}" class="w-100"></a>
        </div>
        <div class="col-6 offset-3">
            <div>
                <p>
                    <span class="font-weight-bold">
                        <a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a>
                    </span> {{ $post->title }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
    {{ $posts->links() }}
</div>


@endsection