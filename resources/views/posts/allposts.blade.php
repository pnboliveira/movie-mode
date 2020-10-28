@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post List') }}</div>
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
                <div class="card-body">
            <table id="list">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Rating</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td><a href="{{route('posts.show',$post->id)}}">{{ $post->title }}</a></td>
                        <td>{{ $post->subtitle }}</td>
                        <td>{{ $post->rating }}</td>
                        <td><img src="{{ url('images/'.$post->image) }}" alt="Bad" /></td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                {{ $posts->links()}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection