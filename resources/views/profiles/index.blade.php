@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 pt-5">
            <img height="180px" src="/storage/{{ $profile->image }}"  class="rounded-circle">
        </div>
        <div class="col-9 pt-5">
            <div class="justify-content-between d-flex align-items-baseline">
                <div class="d-flex align-items-center pb-4">
                    <div class="h4"> {{ $user->username }} </div>
                    <follow-button user-id= {{ $user->id }} follows="{{ $follows ?? ""}}"  status = {{ $is_following }}></follow-button>
                </div>
                @can('update', $profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $profile->user->posts->count() }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $profile->title }}</div> 
            <div>{{ $profile->description }}</div>
            <div><a href="#">{{ $profile->url ?? 'www.google.com'}}</a></div>
        </div>
    </div>

    <hr>

    @foreach($profile->user->posts as $post)
        <div class="row d-flex justify-content-between">
                <div class="col-md-auto">
                    <img src="/storage/{{ $post->image }}" class="rounded-circle" height="50">
                </div>

                <div class="col-md-auto pt-2">
                    <a href="/p/{{ $post->id }}" >
                        <p>{{ substr($post->title . ": " .$post->content,0, 110)}}....</p>
                    </a>
                </div>

                @can('update', $profile)
                    <div class="col-md-auto pt-2">
                        <a href="/p/{{ $post->id}}/edit">
                            <img src="/svg/edit.svg" class="pr-2">
                        </a>    
                        <a href="/p/{{ $post->id }}/delete" class="">
                            <img src="/svg/trash.svg">
                        </a>
                    </div>
                @endcan
        </div>
        <hr>
    @endforeach
</div>
@endsection
