
@foreach($childs as $child)
<li class="nav-item" style="margin-bottom:15px;">
    <a class="nav-link" href="{{$child->url}}" style="font-weight: normal;">
        <span class="nav-link-text">{{$child->title}} 2</span>
    </a>
</li>
@if(count($child->childs))


@include('_partials.manageChildFront',['childs' => $child->childs])
@endif

@endforeach
