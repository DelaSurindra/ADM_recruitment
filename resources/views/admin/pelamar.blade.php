@extends('admin.layout.page')

@section('content')
<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-inline col-10">
                        <h4><strong>List of Applicants</strong></h4>
                    </div>
                </div>

                <hr>
                <form action="{{ route('pelamar') }}" method="GET">
                    <div class="form-row  mb-3">
                        <div class="form-inline col">
                            <div class="form-group">
                                <select name="job" class="form-control mr-2" id="exampleFormControlSelect1">
                                    <option value="">Job Title</option>
                                    @foreach($vacancy as $d)
                                        <option value="{{ $d->job_id }}">{{ $d->job_title }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                        <div class="form-inline col justify-content-end">
                            <div class="form-group mr-0 ">
                                <input name="q" type="text" class="form-control mr-2" placeholder="Find Applicants">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                    @csrf
                </form>

                @if($option != "")
                    <div class="alert alert-info">
                        Filter Job {{ $option->job_title }}
                    </div>
                @endif

                @if(count($pelamar) === 0)
                    <div class="alert alert-info">
                        No Applicants Found
                    </div>
                @else
                    <table class="table table-bordered table-striped mt-2">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelamar as $d => $key)
                                <tr>
                                    <th scope="row">{{ ($pelamar->currentpage()-1) * $pelamar->perpage() + $d + 1 }}</th>
                                    <td>{{ $key->firstname }}</td>
                                    <td>{{ $key->email }}</td>
                                    <td>{{ $key->no_hp }}</td>
                                    <td>{{ $key->job_id }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('pelamar/'.$key->id)}}" type="button" class="btn btn-secondary">Detail</a>
                                            @if($key->file_cv)
                                                <a href="{{ url('pelamar/download/'.$key->id) }}" type="button" class="btn btn-secondary" target="_blank">Download CV</a>
                                            @else
                                                <a href="{{ url('pelamar/download/'.$key->id) }}" type="button" class="btn btn-secondary disabled" >Download CV</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$pelamar->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection