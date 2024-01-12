@extends('layouts/contentNavbarLayout')
@section('title')
SPoT – Product Groups
@endsection
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
<style>
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    /*.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }*/
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }

</style>
@endpush
@section('content')
<style>

.form-check-input:checked[type="checkbox"] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
    }
.form-check-input[type="checkbox"] {
  border-radius: .25em;
}
.form-check-input {
  width: 25px;
  height: 25px;
  border-radius: 5px;
  border: 2px solid #000;
  left: 0;
  margin: 0;
    margin-top: 0px;
  margin-top: 0px;
  padding: 0;
  cursor: pointer;
}
.form-check-input:checked {
  background-color: #0d6efd;
  border-color: #0d6efd;
}


</style>
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
  <div class="breadcrumb-title pr-3">Dashboard</div>
  <div class="pl-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ isset($groupProduct->id) ? 'Update Group' : 'Create Group' }}</li>
      </ol>
    </nav>
  </div>
</div>
<form action="{{ isset($groupProduct->id) ? route('admin.groupProduct.update', $groupProduct->id) : route('admin.groupProduct.store') }}" method="post" enctype="multipart/form-data">
  @csrf
  @isset($groupProduct->id)
  @method('PATCH')
  @endisset
  <div class="row">
    <div class="col-12 col-lg-9">
      <div class="card radius-15 border-lg-top-info">
        <div class="card-header border-bottom-0 mb-4">
          <div class="d-flex align-items-center">
            <div>
              <h5 class="mb-lg-0">{{ isset($groupProduct->id) ? 'Update Product Group' : 'Create Product Group' }}</h5>
            </div>
            <div class="ml-auto">
          
              <a class="btn btn-primary m-1" href="{{ route('admin.groupProduct') }}" data-toggle="tooltip" title="Back to all categories &#9194;"><i class="bx bx-rewind"></i>Back</a>
        
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-body">
            <div class="form-group">
              <label class="col-form-label">Name</label>
              <input type="text" class="form-control  @error('product_group_name') is-invalid @enderror" name="product_group_name" value="{{ $groupProduct->product_group_name ?? old('product_group_name') }}" placeholder="" {{ !isset($groupProduct) ? 'required' : '' }}>
              @error('product_group_name')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

            </div>
           
            <div class="form-group">
              <label class="col-form-label">Description <span class="text-danger">*</span></label>
              <textarea name="description" id="description" class="form-control" required>{{ $product->description ?? old('description') }}</textarea>
              @error('description')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group mt-3">
                <label class="col-form-label">Columns</label>
                <table id="example" class="table table-striped table-bordered text-center table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Size</th>
                    <th>Drawing</th>
                    <th>Orient</th>
                    <th>AreaSM</th>
                    <th>Bottom Butter</th>
                    <th>Racking Butter</th>
                    <th>Man Way</th>
                    <th>Capacity</th>
                </tr>
                </thead>
                <tbody class="list-products">
                    <tr>
                    <td>
                        <input type="checkbox" class="custom-control-input form-check-input"  name="image_flag" @isset($groupProduct->id)
                  {{ $groupProduct->image_flag == 1 ? 'checked' : '' }}
                  @endisset >
                        </td>
                        <td>
                        <input type="checkbox" class="custom-control-input form-check-input"  name="size_flag" @isset($groupProduct->id)
                  {{ $groupProduct->size_flag == 1 ? 'checked' : '' }}
                  @endisset >
                        </td>
                        <td>
                        <input type="checkbox" class="custom-control-input form-check-input"  name="drawing_flag" @isset($groupProduct->id)
                  {{ $groupProduct->drawing_flag == 1 ? 'checked' : '' }}
                  @endisset >
                        </td>
                        <td>
                        <input type="checkbox" class="custom-control-input form-check-input"  name="orient_flag" @isset($groupProduct->id)
                  {{ $groupProduct->orient_flag == 1 ? 'checked' : '' }}
                  @endisset >
                        </td>
                        <td>
                        <input type="checkbox" class="custom-control-input form-check-input"  name="area_sm_flag" @isset($groupProduct->id)
                  {{ $groupProduct->area_sm_flag == 1 ? 'checked' : '' }}
                  @endisset >
                        </td>
                        <td>
                        <input type="checkbox" class="custom-control-input form-check-input"  name="bottom_flag" @isset($groupProduct->id)
                  {{ $groupProduct->bottom_flag == 1 ? 'checked' : '' }}
                  @endisset >
                        </td>
                        <td>
                        <input type="checkbox" class="custom-control-input form-check-input"  name="racking_flag" @isset($groupProduct->id)
                  {{ $groupProduct->racking_flag == 1 ? 'checked' : '' }}
                  @endisset >
                        </td>
                        <td>
                        <input type="checkbox" class="custom-control-input form-check-input"  name="man_way_flag" @isset($groupProduct->id)
                  {{ $groupProduct->man_way_flag == 1 ? 'checked' : '' }}
                  @endisset >
                        </td>
                        <td>
                        <input type="checkbox" class="custom-control-input form-check-input"  name="capacity_flag" @isset($groupProduct->id)
                  {{ $groupProduct->capacity_flag == 1 ? 'checked' : '' }}
                  @endisset >
                        </td>

                    </tr>
                </tbody>
                </table>
            </div>

            <div class="form-group">
                <label class="col-form-label">Add Product</label>
                <input type="text" class="form-control" id="autocomplete-input">
            </div>
            <div class="form-group">
                <label class="col-form-label">Products</label>
                <table id="example" class="table table-striped table-bordered text-center table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="list-products">

                @if (isset($groupProduct->id))
                @foreach($groupProduct->groupItems as $key => $groupItem)
                <tr  class="question">
                    <td>{{$key + 1}}</td>
                    <td>{{ isset($groupItem->product) ? $groupItem->product->product_name_en : ''}}</td>
                    <td>{{isset($groupItem->product) ? $groupItem->product->category->category_name_en : ''}}</td>
                    <td>
                    <input type="hidden" name="productGroupIds[{{$key}}]" value="{{$groupItem->id}}">
                    <input type="hidden" name="productIds[{{$key}}]" value="{{$groupItem->product_id}}">
                    <button class="remove-option btn btn-danger">Remove</button>
                    </td>
                </tr>
              
                @endforeach
                @endif
                </tbody>
                </table>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-3">
      <div class="card radius-15 border-lg-top-info">
        <div class="card-header border-bottom-0 mb-4">
          <div class="d-flex align-items-center">
            <div>
              <h5 class="mb-0">Other info</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-body">
            <div class="form-group">
              <label class="col-form-label">Product Group image</label>
              <input type="hidden" name="image_db" id="image" value="{{$groupProduct->image ?? ''}}"/>
              <input type="file" name="image" class="dropify @error('image') is-invalid @enderror" data-max-file-size-preview="8M" @if (isset($groupProduct->image)) data-default-file="/{{ $groupProduct->image }}" @endif
              {{ !isset($groupProduct->id) ? 'required' : '' }} data-height="160" data-allowed-file-extensions="jpg jpeg png "/>
              @error('image')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="custom-control custom-switch mt-2">
       
              <label class="form-label" for="status">Status</label>
                <select name="status" class="form-select">
                    <option value="">Select Status</option>
                    <option value="1" @isset($groupProduct->id)
              {{ $groupProduct->status == 1 ? 'selected' : '' }}
              @endisset>Active</option>
                    <option value="0" @isset($groupProduct->id)
              {{ $groupProduct->status == 0 ? 'selected' : '' }}
              @endisset>Draft</option>

                </select>

            </div>
            <div class="float-right mt-3">
              <div class="btn-group">
                @if (isset($groupProduct->id))
                <button type="submit" class="btn btn-primary px-2 submit">  Update</button>
                @else
                <button type="submit" class="btn btn-primary px-4 submit" > Save</button>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>


<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        var questionIndex = 1;

        $('body').on('click', '.submit', function(e) {
            e.preventDefault();
            $('form').submit();
        });

        $('body').on('click', '.dropify-clear', function(e) {
            e.preventDefault();
            $('#image').val('');
            
        });

        $("#autocomplete-input").autocomplete({
            source: "{{ route('admin.pages.auto') }}",
            select: function( event, ui ) {
                event.preventDefault();
              
              
                var optionHtml = `
                <tr  class="question">
                    <td>${questionIndex}</td>
                    <td>${ui.item.value}</td>
                    <td>${ui.item.value}</td>
                    <td>
                    <input type="hidden" name="productGroupIds[${questionIndex}]" value="">
                    <input type="hidden" name="productIds[${questionIndex}]" value="${ui.item.id}">
                    <button class="remove-option btn btn-danger">Remove</button>
                    </td>
                </tr>
                `;
                $('.list-products').append(optionHtml);
                $("#autocomplete-input").val('');
                questionIndex++;
              //  $('#product-name').html(ui.item.value);
             //   $('#productId').val(ui.item.id);
             //   $("#autocomplete-input").val(ui.item.value);
            }
        });

        $('.list-products').on('click', '.remove-option', function(e) {
            e.preventDefault();
            $(this).closest('.question').remove();
        });

        $('.list-products').on('click', '.submit', function(e) {
            e.preventDefault();
            $('form').submit();
        });
    });
  window.onload = function() {

        $('.dropify').dropify({
        messages: {
        'default': 'Drag and drop a file here or click'
        , 'replace': 'Drag and drop or click to replace'
        , 'remove': 'Remove'
        , 'error': 'Ooops, something wrong happended.'
        }
        });

                 
    tinymce.init({
        selector: "#description",
        plugins: "   advlist  anchor  autolink autoresize   charmap  code codesample directionality  emoticons    help image importcss  insertdatetime link  lists media    nonbreaking pagebreak   preview quickbars save searchreplace table   tinydrive   visualblocks visualchars wordcount",
        toolbar1: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | indent outdent | wordcount | image link imagetools media   forecolor backcolor ',
        toolbar2: 'table tablecellprops tablecopyrow tablecutrow tabledelete tabledeletecol tabledeleterow tableinsertdialog tableinsertcolafter tableinsertcolbefore tableinsertrowafter tableinsertrowbefore tablemergecells tablepasterowafter tablepasterowbefore tableprops tablerowprops tablesplitcells tableclass tablecellclass tablecellvalign tablecellborderwidth tablecellborderstyle tablecaption tablecellbackgroundcolor tablecellbordercolor tablerowheader tablecolheader myCustomButton ',
        convert_urls: false,
        valid_elements : '*[*]',
        cleanup: false,
        allow_script_urls:true,
        init_instance_callback: function (editor) {
            editor.on("OpenWindow", function(e) {
                const uploadBtns = document.querySelectorAll(".tox-dialog__body-nav-item.tox-tab")
                if(uploadBtns.length === 2) {
                    uploadBtns[1].style.display = "none";

                }
            })
        },
        file_picker_callback: function(callback, value, meta) {
            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            let type = 'image' === meta.filetype ? 'Images' : 'Files',
                url = '/filemanager?editor=tinymce5&type=' + type;

            tinymce.activeEditor.windowManager.openUrl({
                url: url,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        }

    });
}


</script>

@endsection


