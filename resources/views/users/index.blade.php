@extends('layouts/contentNavbarLayout')

@section('title', 'SPoT – Manage Users')



@section('content')
    
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users / </span> List</h4>

    <div class="card">
        <h5 class="card-header"> Manage your users here.
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>
        </h5>
        
        
        <div class="mt-2">
            @include('_partials.messages')
        </div>
        <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
            <tr class="text-nowrap">
                <th scope="col" width="1%">#</th>
                <th scope="col" width="10%">First Name</th>
                <th scope="col" width="10%">Last Name</th>
                <th scope="col">Email</th>
               
                <th scope="col" width="10%">Roles</th>
                <th scope="col" width="1%" colspan="2"></th>    
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                       
                        <td>{{ $user->role }}</td>
                     
                        <td><a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                        <td>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="d-flex">
            {!! $users->links() !!}
        </div>

    </div>
@endsection
