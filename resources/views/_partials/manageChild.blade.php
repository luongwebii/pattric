


<ul>

    @foreach($childs as $child)

    <li class="delete-row">

        <div style="padding: 8px;">
        {{ $child->title }}
        <a onclick="editMenu(this, '{{ $child->title }}', '{{ $child->id }}', '{{ $child->parent_id }}', '{{ $child->url }}')" class="btn btn-sm btn-success"><i class="fadeIn animated bx bx-edit"></i></a> 
        <a  onclick="deleteMenu(this, '{{ $child->id }}', '{{ $child->parent_id }}')" class="btn btn-sm btn-danger delete-confirm"><i class="fadeIn animated bx bx-trash"></i></a>
        </div>

        @if(count($child->childs))

       
        @include('_partials.manageChild',['childs' => $child->childs])

        @endif

    </li>

    @endforeach

</ul>
