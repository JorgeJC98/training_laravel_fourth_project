<x-admin-master>
    @section('content')
        <h1>Edit Role</h1>
        <div class="col-md-4">
            <form action="{{route('admin.permission.update', $permission)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input  type="text" 
                            id="name" 
                            name="name" 
                            class="form-control
                            @error('name') is-invalid @enderror"
                            value="{{$permission->name}}"
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
    @endsection
</x-admin-master>