@extends('layouts/contentNavbarLayout')
@section('title')
All categories
@endsection


@section('content')


<ul>

    @foreach($childs as $child)

    <li>

        <div>
        {{ $child->title }}
        <a onclick="editMenu(this, '{{ $child->title }}', '{{ $child->id }}', '{{ $child->parent_id }}')" class="btn btn-sm btn-success"><i class="fadeIn animated bx bx-edit"></i></a> 
        <a  onclick="deleteMenu('{{ $child->id }}', '{{ $child->parent_id }}')" class="btn btn-sm btn-danger delete-confirm"><i class="fadeIn animated bx bx-trash"></i></a>
        </div>

        @if(count($child->childs))

        @include('manageChild',['childs' => $child->childs])

        @endif

    </li>

    @endforeach

</ul>
@endsection