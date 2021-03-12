@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>SCHOOLS</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/schools/create" title="Create a school">CREATE SCHOOL<i class="fas fa-plus-circle"></i>
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
            <th>Name</th>
            <th>Email</th>
            <th>Website</th>
            <th>Logo</th>
            <th>Actions</th>
        </tr>
        @foreach ($schools as $school)
            <tr>
                <td>{{$school->id}}</td>
                <td>{{$school->name}}</td>
                <td>{{$school->email}}</td>
                <td>{{$school->website}}</td>
                <td>{{asset('schools/'. $school->logo)}}</td>
                <td>
                    <form action="/schools/{{$school->id}}" method="POST">
                        <a href="/schools/{{$school->id}}" title="show">
                            SHOW<i class="fas fa-eye text-success  fa-lg"></i>
                        </a>
                        <a href="/schools/{{$school->id}}/edit">
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

    {!! $schools->links() !!}

@endsection
