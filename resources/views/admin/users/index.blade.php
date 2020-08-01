<x-admin-master>
    @section('content')
        <h1>Users</h1>
          <!-- DataTales Example -->
          @if (Session::has('message'))
              <div class="alert alert-danger">{{Session::get('message')}}</div> 
          @endif
          @if (Session::has('message-success'))
            <div class="alert alert-success">{{Session::get('message-success')}}</div> 
        @endif
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>User Name</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Avatar</th>
                      <th>Create at</th>
                      <th>Update at</th>  
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>User Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Avatar</th>
                        <th>Create at</th>
                        <th>Update at</th>  
                        <th></th>
                    </tr>
                  </tfoot>
                  <tbody> 
                      @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td> <a href="{{route('user.profile',$user->id)}}">{{$user->user_name}}</a></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <img height="50" src="{{$user->avatar}}" alt="avatar">
                            </td>
                            <td>{{$user->created_at->diffForHumans()}}</td> 
                            <td>{{$user->updated_at->diffForHumans()}}</td>  
                            <td>
                                <form action="{{route('user.delete', $user)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                          </tr>
                      @endforeach 
                  </tbody>
                </table>
              </div>
            </div>
          </div> 
    @endsection
    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script> 
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>