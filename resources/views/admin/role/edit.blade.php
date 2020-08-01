<x-admin-master>
    @section('content')
        <h1>Edit Role</h1>
        @if (Session::has('message-success'))
            <div class="alert alert-success">{{Session::get('message-success')}}</div> 
        @endif
        <div class="row">
            <div class="col-md-4">
                <form action="{{route('admin.role.update', $role)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input  type="text" 
                                id="name" 
                                name="name" 
                                class="form-control
                                @error('name') is-invalid @enderror"
                                value="{{$role->name}}"
                                > 
                        <div>
                            @error('name')
                                <span><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form> 
            </div>
        </div>
        @if ($permissions->isNotEmpty()) 
        <hr>
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th> 
                                        <th>Create at</th>
                                        <th>Update at</th>  
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th> 
                                        <th>Create at</th>
                                        <th>Update at</th>  
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                </tfoot>
                                <tbody> 
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="" id=""
                                                @if ($role->permission->contains($permission))
                                                checked
                                                @endif
                                                >
                                            </td>
                                            <td>{{$permission->id}}</td>
                                            <td><a href="{{route('admin.permission.edit', $permission)}}">{{$permission->name}}</a></td>
                                            <td>{{$permission->slug}}</td> 
                                            <td>{{$permission->created_at->diffForHumans()}}</td> 
                                            <td>{{$permission->updated_at->diffForHumans()}}</td>  
                                            <td> 
                                                <form action="{{route('role.permission.attach', $role)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" id="permission" value="{{$permission->id}}"> 
                                                    <button class="btn btn-primary  
                                                            @if ($role->permission->contains($permission))
                                                            disabled
                                                            @endif"
                                                            >Attach</button>
                                                </form> 
                                            </td>
                                            <td> 
                                                <form action="{{route('role.permission.detach', $role)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" id="permission" value="{{$permission->id}}"> 
                                                    <button class="btn btn-danger  
                                                            @if (!$role->permission->contains($permission))
                                                            disabled
                                                            @endif"
                                                            >Detach</button>
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
        @endif
    @endsection
    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script> 
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>