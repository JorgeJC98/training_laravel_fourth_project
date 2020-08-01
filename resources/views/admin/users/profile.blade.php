<x-admin-master>
    @section('content')
        <h1>User Profile</h1> 
        <div class="row">
            <div class="col-sm-6">
                <form method="POST" action="{{route('user.update', $user)}}" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    @if (count($errors) > 0)  
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </div> 
                    @endif
                    <div class="mb-4">
                        <img height="100px" class="img-profile rounded-circle" src="{{$user->avatar}}">
                    </div>
                    <div class="form-gorup">
                        <input type="file" name="avatar" id="avatar">
                    </div>
                    <div class="form-group">
                        <label for="user_name">User Name</label>
                        <input type="text" name="user_name" class="form-control" id="user_name" value="{{$user->user_name}}">
                    </div> 
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                    </div> 
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
                    </div> 
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div> 
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                    </div> 
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8> 
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th> 
                                <th>Name</th> 
                                <th>Slug</th> 
                                <th>Attach</th> 
                                <th>Detach</th> 
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th> 
                                <th>Name</th> 
                                <th>Slug</th> 
                                <th>Attach</th> 
                                <th>Detach</th> 
                            </tr>
                        </tfoot>
                        <tbody> 
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td> 
                                    <td>{{$role->name}}</td> 
                                    <td>{{$role->slug}}</td> 
                                    <td> 
                                        <form action="{{route('user.role.attach', $user)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="role" id="role" value="{{$role->id}}">
                                            <button class="btn btn-primary"
                                                @if ($user->roles->contains($role))
                                                    disabled
                                                @endif>
                                                Attach</button>
                                        </form>
                                    </td> 
                                    <td>
                                         <form action="{{route('user.role.detach', $user)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="role" id="role" value="{{$role->id}}">
                                            <button class="btn btn-danger" 
                                                @if (!$user->roles->contains($role))
                                                disabled
                                                @endif>
                                            Detach</button>
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
</x-admin-master>