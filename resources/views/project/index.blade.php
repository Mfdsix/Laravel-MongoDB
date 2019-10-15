@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Projects</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Project Datas</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="text-right">
                                <a href="{{ route('project.create') }}" class="btn btn-sm btn-success">Add Projects</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Start</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($datas) == 0)
                            <tr>
                                <td colspan="5" class="text-center">You have no project.</td>
                            </tr>
                            @else
                            @foreach($datas as $k => $v)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{ $v->title }}</td>
                                <td>{{ $v->start }}</td>
                                <td>{{ $v->status }}</td>
                                <td>
                                    @if($v->status == 'New')
                                    <a href="{{ route('project.take', $v->id) }}" class="btn btn-sm btn-primary">Take</a>
                                    @elseif($v->status == 'Progress')
                                    <a href="{{ route('project.finish', $v->id) }}" class="btn btn-sm btn-success">Finish</a>
                                    @endif
                                    <a href="{{ route('project.edit', $v->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('project.delete', $v->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection