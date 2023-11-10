@extends('layouts/contentNavbarLayout')
@section('title')
All categories
@endsection

@section('content')
       
@extends('layouts.app')

@section('content')
    <h1>List of Menus</h1>
    <ul>
        @foreach($menus as $menu)
            <li>
                {{ $menu->name }}
                <a href="{{ route('menu.edit', $menu->id) }}">Edit</a>
                <form method="POST" action="{{ route('menu.delete', $menu->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
