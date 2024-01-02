@extends('layouts/contentNavbarLayout')
@section('title')
SPoT – Products
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/css/select2-bootstrap4.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/input-tags/css/tagsinput.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
<link rel="stylesheet" href="{{ asset('backend/assets/css/multiimage.css') }}" />
@endpush
@section('content')
<div class="product-breadcrumb d-none d-md-flex align-items-center mb-3">
  <div class="breadcrumb-title pr-3">Dashboard</div>
  <div class="pl-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"></a>
        </li>
        <li class="breadcrumb-item active" aria-current="product">
          {{ isset($product->id) ? 'Update product' : 'Create product' }}</li>
      </ol>
    </nav>
  </div>
</div>
<form action="{{ isset($product->id) ? route('admin.product.update', $product->id) : route('admin.product.store') }}" method="post" enctype="multipart/form-data">
  @csrf
  @isset($product->id)
  @method('PUT')
  @endisset
  <div class="row">
    <div class="col-12 col-lg-8">
      <div class="card radius-15 border-lg-top-info">
        <div class="card-header border-bottom-0">
          <div class="d-flex align-items-center">
            <div>
              <h5 class="mb-lg-0"> {{ isset($product->id) ? 'Update product' : 'Create product' }}</h5>
            </div>
            <div class="ml-auto">
           
              <a class="btn btn-primary" href="{{ route('admin.product') }}" data-toggle="tooltip" title="Back to products &#9194;"><i class="bx bx-rewind"></i>Back</a>
           
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-body">

            <div class="form-row">

              <div class="form-group col-md-6">
                <label class=" col-form-label">Category <span class="text-danger">*</span></label>
                <select class="form-control single-select" name="category_id1" id="category_id1">
                  <option value="">Select Category</option>

                 

                  @foreach ($categoryData as $categoryList)
                  @if (!empty($categoryList->parent_id))
                    <option value="{{ $categoryList->id }}" {{ $categoryList->id === old('parent_id') ? 'selected' : '' }}>{{ $categoryList->category_name_en }}</option>
                    @if ($categoryList->children)
                        @foreach ($categoryList->children as $child)
                            <option value="{{ $child->id }}" {{ $child->id === old('parent_id') ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->category_name_en }}</option>
                        @endforeach
                    @endif
                    @endif

                  
                  @endforeach
                </select>
                @if ($errors->has('category_id1'))
                        <span class="text-danger text-left">{{ $errors->first('category_id1') }}</span>
                    @endif
                
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label class="col-form-label">Model <span class="text-danger">*</span></label>
                <input type="text" class="form-control  @error('model') is-invalid @enderror" name="model" value="{{ $product->model ?? old('model') }}" placeholder="Model" required>
                @error('model')
                <span class="text-danger" product="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label class="col-form-label">Product Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control  @error('product_name_en') is-invalid @enderror" name="product_name_en" value="{{ $product->product_name_en ?? old('product_name_en') }}" placeholder="Product Name" required>
                @error('product_name_en')
                <span class="text-danger" product="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>


            <div class="form-row">
              <div class="form-group col-md-12">
                <label class="col-form-label">Quantity <span class="text-danger">*</span></label>
                <input type="text" class="form-control  @error('product_qty') is-invalid @enderror" name="product_qty" value="{{ $product->product_qty ?? old('product_qty') }}" placeholder="Product quantity" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="5" required>
                @error('product_qty')
                <span class="text-danger" product="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label class="col-form-label">Price <span class="text-danger">*</span></label>
                <input type="text" class="form-control  @error('price') is-invalid @enderror" name="price" value="{{ $product->price ?? old('price') }}" placeholder="Product Price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" required>
                @error('price')
                <span class="text-danger" product="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label class="col-form-label">Sale Price <span class="text-danger"></span></label>
                <input type="text" class="form-control  @error('sale_price') is-invalid @enderror" name="sale_price" value="{{ $product->sale_price ?? old('sale_price') }}" placeholder="Product Sale Price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" >
                @error('sale_price')
                <span class="text-danger" product="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label class="col-form-label">Drawing</label>
                <input type="text" class="form-control  @error('drawing') is-invalid @enderror" name="drawing" value="{{ $product->drawing ?? old('drawing') }}" placeholder="Drawing" >
                @error('drawing')
                <span class="text-danger" product="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group">
              <label class="col-form-label">Orient</label>
              <input type="text" class="form-control  @error('orient') is-invalid @enderror" name="orient" value="{{ $product->orient ?? old('orient') }}" placeholder="Orient" >
              @error('orient')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="col-form-label">Orient</label>
              <input type="text" class="form-control  @error('orient') is-invalid @enderror" name="orient" value="{{ $product->orient ?? old('orient') }}" placeholder="Orient" >
              @error('orient')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="col-form-label">Orient</label>
              <input type="text" class="form-control  @error('orient') is-invalid @enderror" name="orient" value="{{ $product->orient ?? old('orient') }}" placeholder="Orient" >
              @error('orient')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="col-form-label">AreaSM</label>
              <input type="text" class="form-control  @error('area_sm') is-invalid @enderror" name="area_sm" value="{{ $product->area_sm ?? old('area_sm') }}" placeholder="AreaSM" >
              @error('area_sm')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="col-form-label">Bottom Butter</label>
              <input type="text" class="form-control  @error('bottom_butter') is-invalid @enderror" name="bottom_butter" value="{{ $product->bottom_butter ?? old('bottom_butter') }}" placeholder="Bottom Butter" >
              @error('bottom_butter')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="col-form-label">Racking Butter</label>
              <input type="text" class="form-control  @error('racking_butter') is-invalid @enderror" name="racking_butter" value="{{ $product->racking_butter ?? old('racking_butter') }}" placeholder="Racking Butter" >
              @error('racking_butter')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="col-form-label">Man Way</label>
              <input type="text" class="form-control  @error('man_way') is-invalid @enderror" name="man_way" value="{{ $product->man_way ?? old('man_way') }}" placeholder="Man Way" >
              @error('man_way')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label class="col-form-label">Capacity</label>
              <input type="text" class="form-control  @error('capacity') is-invalid @enderror" name="capacity" value="{{ $product->capacity ?? old('capacity') }}" placeholder="Capacity" >
              @error('capacity')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>


            <div class="form-group">
              <label class="col-form-label">Long description <span class="text-danger"></span></label>
              <textarea name="long_description_en" id="long_description_en" class="form-control" >{{ $product->long_description_en ?? old('long_description_en') }}</textarea>
              @error('long_description_en')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>


          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card radius-15 border-lg-top-info">
        <div class="card-header border-bottom-0 mb-4">
          <div class="d-flex align-items-center">
            <div>
              <h5 class="mb-0">Other information</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-body">

           




            <div class="form-group">
              <label class="col-form-label">Main Thambnail <span class="text-danger"></span></label>
              <input type="file" name="image" class="dropify @error('image') is-invalid @enderror" data-max-file-size-preview="8M" @if (isset($product->image))
              data-default-file="/{{ $product->image }}" @endif
              {{ !isset($product->id) ? '' : '' }} />
              @error('image')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' id="files" name="multi_img[]" multiple accept="image/*" />
                <div class="drag-text">
                  <h3>Product Multiple Image</h3>
                </div>
              </div>
            </div>



            <div class="form-group  mt-3">
              <label class="col-form-label">Meta Title</label>
              <textarea name="meta_keywords_en" id="meta_keywords_en" class="form-control  @error('title') is-invalid @enderror" placeholder="Meta description">{{ $product->meta_keywords_en ?? old('meta_keywords_en') }}</textarea>
              @error('meta_keywords_en')
              <span class="text-danger" product="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>




            <div class="form-row  mt-3">

              <div class="form-group col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="featured" name="featured" @isset($product->id)
                  {{ $product->featured == 1 ? 'selected' : '' }}
                  @endisset>
                  <label class="custom-control-label" for="featured">Featured</label>
                </div>
                @error('featured')
                <span class="text-danger" product="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>



            <div class="custom-control custom-switch  mt-3">
              
            <label class="custom-control-label" for="status">Status</label>

            <select name="status" id="cars"  class="form-control">
            <option value="">Select Status</option>
            <option value="1"  >Active</option>
            <option value="0" >Draft</option>
            </select>

            </div>
            <div class="float-right">
              <div class="btn-group mt-2">
                @if (isset($product->id))
                <button type="submit" class="btn btn-primary px-2 submit" data-toggle="tooltip" title="Update those data &#128190;">Update</button>
                @else
                <button type="submit" class="btn btn-primary px-4 submit" data-toggle="tooltip" title="Save to database &#128190;"> Save</button>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</form>


<script type="text/javascript">


    $(document).ready(function() {

        $('body').on('click', '.submit', function(e) {
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
        selector: "#long_description_en",
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

