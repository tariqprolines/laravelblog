@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
        @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 justify-content-center user-profile">
            <div>
            @if(!empty($profiles))
                <p><img src="{{asset('uploads/profile/'.$profiles->profile_image)}}" class="img-fluid img-thumbnail"/></p>
                <p>{{ $username }}</p>
                <p>{{ $profiles->designation }}</p>
            @else
                <p><img src="{{asset('uploads/profile/user.png')}}" class="img-fluid img-thumbnail"/></p>
            @endif 
            </div>
            <div class="categories">
                <h4>Categories</h4>
                <div>
                    <ul class="list-group">
                        @if(!empty($categories))
                            @foreach($categories as $category)
                                <li class="list-group-item">
                                   <a href="{{url('filterCategory',strtolower($category->name))}}">{{$category->name}}</a>
                                </li>
                            @endforeach    
                        @else
                            <li class="list-group-item">Category is not available</li>
                        @endif    
                    </ul>
                </div>
            </div>   
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                @if(count($posts) > 0)
                   @foreach($posts as $post)
                   <div class="post-box">
                        <p class="title">{{$post->title}}</p>
                        <p><img src="{{asset('uploads/'.$post->featured_image)}}" class="img-fluid"/></p>
                        <p class="body">{{$post->body}}</p>
                        <p>
                            <a href="{{ url('/viewPost', $post->id)}}"><i class="fa fa-eye"></i> View</a>
                            @can('isAdmin')
                            <a href="{{url('/editPost', $post->id)}}"><i class="fa fa-edit"></i> Edit</a>
                            <a href="{{url('/deletePost', $post->id)}}" onclick="return confirm('Are you want to delete this post?')"><i class="fa fa-trash"></i> Delete</a>
                            @endcan
                        </p>
                    </div> 
                   @endforeach
                @else
                    Post is not available   
                @endif   
                </div>
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
