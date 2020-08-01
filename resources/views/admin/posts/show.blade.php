<x-admin-master>
    @section('content')
        <h1>Post</h1>   
        <div> <h1>{{$post->title}}</h1> </div>
        <div> <img height="50" src="{{$post->post_image}}" alt="post_image"> </div>
        <p>{{$post->body}}</p>
        
    @endsection
</x-admin-master>