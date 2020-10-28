@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit post')}}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.update', $post->id )}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="article" class="col-md-4 col-form-label text-md-right">{{ __('Review') }}</label>
                            <div class="col-md-6">
                                <textarea id="article" type="text"
                                    class="form-control @error('article') is-invalid @enderror" name="article"
                                    value="{{ old('article', $post->article) }}" required autocomplete="article" autofocus>
                                    {{$post->article}}
                                </textarea>
                                @error('article')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rating" class="col-md-4 col-form-label text-md-right">{{ __('Rating') }}</label>
                            <div class="col-md-6">
                                <input id="rating" type="text"
                                    class="form-control @error('rating') is-invalid @enderror" name="rating"
                                    value="{{ old('rating', $post->rating) }}" required autocomplete="rating" autofocus>
                                @error('rating')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <img src="{{asset('images/'. $post->image)}}">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ url('posts') }}">Back to List</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection