@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Add New Post</h1>
                </div>
                <div class="row mb-3">
                    <label for="title" class="col-md-4 col-form-label">Post title</label>
            
                        <input id="title" 
                        type="title" class="form-control @error('title') is-invalid @enderror" 
                        name="title" 
                        value="{{ old('title') }}"
                        autocomplete="title">
            
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="row">
                    <label for="caption" class="col-md-4 col-form-label">Content</label>
                    <textarea name="content" id="content" class="form-control" rows="20"></textarea>

                    @error('content')
                        <strong>{{ $message }}</strong>
                @enderror
                </div>

                <div class="row pt-4">
                    <label for="caption" class="col-md-4 col-form-label">Post Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">

                    @error('image')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary" onclick="func()">Add New Post</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

<script>
    function func() {
        alert('Helo World');
    }
</script>