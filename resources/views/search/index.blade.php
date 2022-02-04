@extends('layouts.app')

@section('content')

<div class="container" style="width:25%">
    @if($message)
        <div class="row justify-content-end">
            <div class="col pb-4">
                <p>User Not Found</p>
            </div>
        </div>
        @foreach($users  as $user)
            <div class="row">
                <div class="col">
                    <a href="profile/{{ $user->id }}">
                        <p>{{ $user->name }}</p>
                    </a>
                </div>

                <div class="col">
                    <p>{{ $user->profile->title }}</p>
                </div>
                <hr>
            </div>
        @endforeach
    @else
        @foreach($users  as $user)
            <div class="row">
                <div class="col">
                    <a href="profile/{{ $user->id }}">
                        <p>{{ $user->name }}</p>
                    </a>
                </div>

                <div class="col">
                    <p>{{ $user->profile->title }}</p>
                </div>
                <hr>
            </div>
        @endforeach
    @endif
</div>

@endsection