@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Create')



@section('content')
    <div class="card mb-4">

        <h5 class="card-header">Add new user and assign role.</h5>
    
        <div class="card-body">
            <form method="POST"  action="{{ route('admin.users.store') }}">
                @csrf
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">First Name *</label>
                    <input value="{{ old('first_name') }}" 
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
                    <input value="{{ old('last_name') }}" 
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
                    <input value="{{ old('email') }}"
                        type="email" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="Password" class="form-label">Password *</label>
                    <input value="{{ old('password') }}"
                        type="password" 
                        class="form-control" 
                        name="password" 
                        placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Role</label>
                    <select class="form-select form-select-lg" name="role" aria-label="Default select example">
                    @foreach($roleArray as $key => $type)
                            <option value="{{ $key }}" {{ (old("role") == $key ? "selected":"") }}>{{ $type }}</option>
                    @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save user</button>
                <a href="{{ route('admin.users') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
