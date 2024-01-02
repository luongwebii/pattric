@extends('layouts/contentNavbarLayout')

@section('title', 'SPoT – Manage Users')



@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('admin.users') }}" >Users</a> / </span> Edit</h4>
    <div class="card">
     
        <h5 class="card-header">Update user.</h5>
        <div class="card-body">
            <form method="post" action="{{ route('admin.users.update', $user->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">First Name *</label>
                    <input value="{{ $user->first_name }}" 
                        type="text" 
                        class="form-control" 
                        name="first_name" 
                        placeholder="First Name" required>

                    @if ($errors->has('first_name'))
                        <span class="text-danger text-left">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Last Name *</label>
                    <input value="{{ $user->last_name }}" 
                        type="text" 
                        class="form-control" 
                        name="last_name" 
                        placeholder="Last Name" required>

                    @if ($errors->has('last_name'))
                        <span class="text-danger text-left">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>

                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email *</label>
                    <input value="{{ $user->email }}"
                        type="email" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="Password" class="form-label">Password (Leave blank to keep the same password)</label>
                    <input value=""
                        type="password" 
                        class="form-control" 
                        name="password" 
                        placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
              

                <button type="submit" class="btn btn-primary">Update user</button>
                
            </form>
        </div>

    </div>
@endsection
