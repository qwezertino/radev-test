@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>WORKERS</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/workers/create" title="Create a school">CREATE WORKER<i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>School</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        @foreach ($workers as $worker)
            <tr>
                <td>{{$worker->id}}</td>
                <td>{{$worker->firstname}}</td>
                <td>{{$worker->lastname}}</td>
                <td>{{$worker->schools->name}}</td>
                <td>{{$worker->email}}</td>
                <td>{{$worker->phone}}</td>
                <td>
                    <form action="/workers/{{$worker->id}}" method="POST">
                        <a href="/workers/{{$worker->id}}" title="show">
                            SHOW<i class="fas fa-eye text-success  fa-lg"></i>
                        </a>
                        <a href="/workers/{{$worker->id}}/edit">
                            EDIT<i class="fas fa-edit  fa-lg"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            DELETE<i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $workers->links() !!}

@endsection
