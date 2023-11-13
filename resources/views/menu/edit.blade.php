@extends('layouts.app')

@section('content')
    <h1>Edit Menu</h1>
    <form method="POST" action="{{ route('menu.update', $menu->id) }}">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $menu->name }}" placeholder="Menu Name">
        <button type="submit">Update</button>
    </form>
@endsection