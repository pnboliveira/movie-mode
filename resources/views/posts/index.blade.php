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
<th>Id</th>
<th>Title</th>
<th>Code</th>
<th>Description</th>
<th>Price</th>
<th>Image</th>
<td colspan="2">Action</td>
</tr>
</thead>
<tbody>
@foreach($posts as $post)
<tr>
<td>{{ $post->id }}</td>
<td>{{ $post->title }}</td>
<td>{{ $post->subtitle }}</td>
<td>{{ $post->article }}</td>
<td>{{ $post->rating }}</td>
<td><img src="{{ url('images/'.$post->image) }}" alt="Bad"/></td>
<td><a href="{{ route('posts.edit',$post->id) }}">Edit</a></td>
<td>
<form action="{{ route('posts.destroy', $post->id)}}" method="post">
{{ csrf_field() }}
@method('DELETE')
<button class="btn btn-danger" type="submit">Delete</button>
</form>
</td>
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