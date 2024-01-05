@extends('layouts/contentNavbarLayout')
@section('title')
SPoT – Pages
@endsection

@section('content')
<style>
    .autocomplete-popup {
        position: absolute;
        top: 30px;
        left: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        z-index: 9999;
    }

    .autocomplete-popup ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .autocomplete-popup li {
        cursor: pointer;
        padding: 5px;
    }

    .autocomplete-popup li:hover {
        background-color: #f0f0f0;
    }
</style>
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3">Dashboard</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tax</li>
            </ol>
        </nav>
    </div>
</div>
<div class="mt-2">
        @include('_partials.messages')
    </div>
<form action="{{ route('option.submit') }}" method="post" >
    @csrf

    <input type="hidden" name="id" value="{{$option->id ?? ''}}" />
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card radius-15 border-lg-top-info">
                <div class="card-header border-bottom-0 mb-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-lg-0">Tax</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-form-label">Value</label>
                            <input type="text" class="form-control  @error('value') is-invalid @enderror" name="value" value="{{ $option->value ?? old('value') }}" placeholder="value" >
                            @error('value')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
          
                        <div class="form-group mt-3">
                            <div class="btn-group">
                            <button type="submit" class="btn btn-primary px-2" data-toggle="tooltip" title="Update those data &#128190;"> Update</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</form>



@endsection