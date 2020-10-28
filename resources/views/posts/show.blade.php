@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">

      <!-- Post Content Column -->
      <div class="col-md-8">

        <!-- Title -->
        <h1 class="mt-4">{{$post->title}}</h1>
    
            <!-- Author -->
            <p class="lead">
              {{$post->subtitle}} - Rating: {{$post->rating}}/5
            </p>
    
            <hr>
    
            <!-- Date/Time -->
            <p>Posted on {{$post->created_at}}</p>
    
            <hr>
    
            <!-- Preview Image -->
            <img class="img-fluid rounded" src="{{url('images/'.$post->image)}}" alt="">
    
            <hr>
    
            <!-- Post Content -->
            
    
            <p>{{$post->article}}</p>

        <!-- Comments Form -->
        <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>
                    </form>
                    

        <!-- Comment with nested comments -->
    

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        &nbsp;

    </div>
    <!-- /.row -->

  </div>
  @endsection