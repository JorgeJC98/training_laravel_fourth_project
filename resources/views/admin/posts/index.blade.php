<x-admin-master>
    @section('content')
        <h1>All Posts</h1>
          <!-- DataTales Example -->
          @if (Session::has('message'))
              <div class="alert alert-danger">{{Session::get('message')}}</div> 
          @endif
          @if (Session::has('message-success'))
            <div class="alert alert-success">{{Session::get('message-success')}}</div> 
        @endif
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Posts</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Owner</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Create at</th>
                      <th>Update at</th> 
                      <th>Options</th> 
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Owner</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Create at</th>
                      <th>Update at</th>
                      <th>Options</th>  
                    </tr>
                  </tfoot>
                  <tbody> 
                      @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->user->name}}</td>
                            <td><a href="{{route('post.show', $post)}}">{{$post->title}}</a></td>
                            <td>
                                <img height="50" src="{{$post->post_image}}" alt="post_image">
                            </td>
                            <td>{{$post->created_at->diffForHumans()}}</td> 
                            <td>{{$post->updated_at->diffForHumans()}}</td> 
                            <td>
                              @can('view', $post)
                                <form action="{{route('post.delete', $post)}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{route('post.edit', $post)}}" class="btn btn-warning">Edit</a> 
                              @endcan 
                            </td>
                          </tr>
                      @endforeach 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="d-flex">
            <div class="mx-auto">
              {{$posts->links()}}
            </div>
          </div> 
    @endsection
    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
    @endsection
</x-admin-master>