@extends('admin.layout.page')

@section('content')
<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-inline col-10">
                        <h4><strong>List of User Admin</strong></h4>
                    </div>
                    <div class="form-inline col justify-content-end">
                        <a href="{{ route('formUser')}}" class="btn btn-outline-primary">Add New Admin</a>
                    </div>
                </div>

                <hr>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered table-striped mt-2">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date register</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $d => $key)
                            <tr>
                                <th scope="row">{{ ($user->currentpage()-1) * $user->perpage() + $d + 1 }}</th>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->email }}</td>
                                <td>
                                    @if($key->status)
                                        <h5><span class="badge badge-success">Active</span></h5>
                                    @else
                                        <h5><span class="badge badge-Danger">Block</span></h5>
                                    @endif
                                </td>
                                <td>{{ $key->created_at }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    @if($id != $key->id)
                                        @if($key->status == false)
                                            <a href="{{url('admin/user/active/'.$key->id)}}" type="button" class="btn btn-success">Activate</a>
                                        @else
                                            <a href="{{url('admin/user/block/'.$key->id)}}" type="button" class="btn btn-danger">Block</a>
                                        @endif
                                    @else
                                        It's You
                                    @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$user->links()}}
            </div>
        </div>
    </div>
</div>
@endsection