<x-admin-master>
    @section('content')
        <h1>Create Post</h1>  
        @if (count($errors) > 0)  
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div> 
        @endif
        <form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
            @csrf
           
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="file">File</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image">
            </div>
            <div>
                <label for="body">Body</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control"  placeholder="Enter body"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
    @endsection
</x-admin-master>