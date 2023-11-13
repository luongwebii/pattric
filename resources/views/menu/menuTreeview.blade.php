@extends('layouts/contentNavbarLayout')
@section('title')
All categories
@endsection
@push('css')
<style>

#tree1 a.btn{color:#fff;}
</style>
@endpush
@section('content')

<div class="container">

<div class="row">

   <div class="col-md-10 offset-md-1 mt-4">

      <div class="card">

         <div class="card-header">

            <h5>Menu</h5>

         </div>

         <div class="card-body">

            <div class="row">

               <div class="col-md-6">

                  <h5 class="mb-4 text-center bg-success text-white ">Add New Menu</h5>

                  <form accept="{{ route('menus.store')}}" method="post">
                     @csrf
                      <input type="hidden" name="id" id="id" value=""/>
                      @if(count($errors) > 0)

                               <div class="alert alert-danger  alert-dismissible">


                                   @foreach($errors->all() as $error)

                                           {{ $error }}<br>

                                   @endforeach

                               </div>

                           @endif

                       @if ($message = Session::get('success'))

                        <div class="alert alert-success  alert-dismissible">

                         

                                <strong>{{ $message }}</strong>

                        </div>

                     @endif

                     <div class="row">

                        <div class="col-md-12">

                           <div class="form-group">

                              <label>Title</label>

                              <input type="text" name="title" class="form-control"  id="title">   

                           </div>

                        </div>

                     </div>

                     <div class="row">

                        <div class="col-md-12">

                           <div class="form-group">

                              <label>Parent</label>

                              <select class="form-control" name="parent_id" id="parent_id">

                                 <option selected disabled>Select Parent Menu</option>

                                 @foreach($allMenus as $key => $value)

                                    <option value="{{ $key }}">{{ $value}}</option>

                                 @endforeach

                              </select>

                           </div>

                        </div>

                     </div>

                     <div class="row">

                        <div class="col-md-12 mt-2">

                           <button class="btn btn-success">Save</button>

                        </div>

                     </div>

                  </form>

               </div>

               <div class="col-md-6">

                  <h5 class="text-center mb-4 bg-info text-white">Menu List</h5>

                   <ul id="tree1">

                      @foreach($menus as $menu)

                         <li class="delete-row">

                             <div>{{ $menu->title }} <a onclick="editMenu(this, '{{ $menu->title }}', '{{ $menu->id }}', '{{ $menu->parent_id }}')" class="btn btn-sm btn-success"><i class="fadeIn animated bx bx-edit"></i></a> <a  onclick="deleteMenu(this, '{{ $menu->id }}', '{{ $menu->parent_id }}')" class="btn btn-sm btn-danger delete-confirm"><i class="fadeIn animated bx bx-trash"></i></a></div>

                             @if(count($menu->childs))
                                 @include('_partials.manageChild',['childs' => $menu->childs])
                             

                             @endif

                         </li>

                      @endforeach

                     </ul>

               </div>

            </div>

         </div>

      </div>

   </div>

</div>

</div>


<script type="text/javascript">
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
        $('#questions').on('click', '.remove-option', function(e) {
            e.preventDefault();
            $(this).closest('.answer-option').remove();
        });

        $('#questions').on('click', '.remove-question', function(e) {
            e.preventDefault();
            if(confirm('Are you sure you want to remove this question + answers?')) {
                $(this).closest('.question').remove();
            }
           
        });
    });

    function deleteMenu(elem, id, parent_id){
        if(confirm('Are you sure you want to remove this menu?')) {
            $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {id:id, parent_id: parent_id},
            url: "{{ route('menus.remove') }}",
            success: function(data){

               
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type:'success',
                        title: data.success,
                    })
                    jQuery(elem).closest(".delete-row").remove();
                }else{
                    Toast.fire({
                        type: 'error',
                        title:data.error,
                    })
                }

             
            }
        })
        }

    }

    function editMenu(elem, title, id, parent_id){

        $('#title').val(title);
        $('#id').val(id);
        $('#parent_id').val(parent_id);
      
    }

</script>
@endsection
