<x-admin-master>
    @section('content')
        <h1>Editing Post</h1>  
        @if (count($errors) > 0)  
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div> 
        @endif
        <form method="POST" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter title" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <div> <img height="50" src="{{$post->post_image}}" alt="post_image"></div>
                <label for="file">File</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image">
            </div>
            <div>
                <label for="body">Body</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control"  placeholder="Enter body">{{$post->body}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
    @endsection
</x-admin-master>