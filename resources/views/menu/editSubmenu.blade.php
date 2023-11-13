@extends('layouts.app')

@section('content')
    <h1>Edit Submenu</h1>
    <form method="POST" action="{{ route('submenu.update', [$menu->id, $submenu->id]) }}">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $submenu->name }}" placeholder="Submenu Name">
        <button type="submit">Update</button>
    </form>
@endsection