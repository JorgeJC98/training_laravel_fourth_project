<x-admin-master>
    @section('content')
        <h1>Permissions</h1>
        <div class="row">
            <div class="col-sm-3">
                <form action="{{route('admin.permission.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input  type="text" 
                                id="name" 
                                name="name" 
                                class="form-control
                                @error('name') is-invalid @enderror"
                                > 
                        <div>
                            @error('name')
                                <span><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                </form>
            </div>
            <div class="col-sm-9">
                @if (Session::has('message-delete'))
                    <div class="alert alert-danger">{{Session::get('message-delete')}}</div> 
                @endif
                @if (Session::has('message-success'))
                    <div class="alert alert-success">{{Session::get('message-success')}}</div> 
                @endif
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th> 
                                <th>Create at</th>
                                <th>Update at</th>  
                                <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th> 
                                    <th>Create at</th>
                                    <th>Update at</th>  
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody> 
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td><a href="{{route('admin.permission.edit', $permission)}}">{{$permission->name}}</a></td>
                                        <td>{{$permission->slug}}</td> 
                                        <td>{{$permission->created_at->diffForHumans()}}</td> 
                                        <td>{{$permission->updated_at->diffForHumans()}}</td>  
                                        <td>
                                            <form action="{{route('admin.permission.delete', $permission)}}" method="POST">
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