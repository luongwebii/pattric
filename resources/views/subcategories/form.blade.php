@extends('layouts/contentNavbarLayout')
@section('title')
{{ isset($subcategory->id) ? 'Update subcategory' : 'Create subcategory' }}
@endsection

@section('content')
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
  <div class="breadcrumb-title pr-3">Dashboard</div>
  <div class="pl-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class='bx bx-home-alt'></i></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ isset($subcategory->id) ? 'Update subcategory' : 'Create subcategory' }}</li>
      </ol>
    </nav>
  </div>
</div>
<form action="{{ isset($subcategory->id) ? route('admin.subcategory.update', $subcategory->id) : route('admin.subcategory.store') }}" method="post" enctype="multipart/form-data">
  @csrf
  @isset($subcategory->id)
  @method('PATCH')
  @endisset
  <div class="row">
    <div class="col-12 col-lg-8">
      <div class="card radius-15 border-lg-top-info">
        <div class="card-header border-bottom-0 mb-1">
          <div class="d-flex align-items-center">
            <div>
              <h5 class="mb-lg-0">{{ isset($subcategory->id) ? 'Update subcategory' : 'Create subcategory' }}</h5>
            </div>
            <div class="ml-auto">
           
              <a class="btn btn-primary m-1" href="{{ route('admin.subcategory') }}" data-toggle="tooltip" title="Back to all subcategories &#9194;"><i class="bx bx-rewind"></i>Back</a>
            
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-body">
            <div class="form-group">
              <label class="col-form-label">Name</label>
              <input type="text" class="form-control  @error('subcategory_name_en') is-invalid @enderror" name="subcategory_name_en" value="{{ $subcategory->subcategory_name_en ?? old('subcategory_name_en') }}" placeholder="" {{ !isset($subcategory) ? 'required' : '' }}>
              @error('subcategory_name_en')
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

          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
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
              <label class=" col-form-label">Select Category</label>
              <select class="form-control single-select" name="category_id">
                @foreach ($categories as $category) <option value="{{ $category->id }}" @isset($subcategory->id)
                {{ $subcategory->category_id == $category->id ? 'selected' : '' }}
                @endisset
                >
                {{ $category->category_name_en }} / {{ $category->category_name_bn }}
                </option>
                @endforeach

              </select>

            </div>

           


            <div class="form-group">
              <label class="col-form-label">Sub Category image</label>
              <input type="file" name="image" class="dropify @error('image') is-invalid @enderror" data-max-file-size-preview="8M" @if (isset($subcategory->image)) data-default-file="/{{ $subcategory->image }}" @endif
              {{ !isset($subcategory->id) ? '' : '' }} data-height="160" data-allowed-file-extensions="jpg jpeg png "/>
              @error('image')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="status" name="status" @isset($subcategory->id)
              {{ $subcategory->status == 1 ? 'checked' : '' }}
              @endisset
              >
              <label class="custom-control-label" for="status">Status</label>
            </div>
            <div class="float-right">
              <div class="btn-group">
                @if (isset($subcategory->id))
                <button type="submit" class="btn btn-primary px-2" ><i class="bx bx-task"></i> Update</button>
                @else
                <button type="submit" class="btn btn-primary px-4" > <i class="bx bx-save"></i> Save</button>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>


<script>
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
        plugins: "a11ychecker advcode advlist advtable anchor autocorrect autolink autoresize autosave casechange charmap checklist code codesample directionality editimage emoticons export footnotes formatpainter fullscreen help image importcss inlinecss insertdatetime link linkchecker lists media mediaembed mentions mergetags nonbreaking pagebreak pageembed permanentpen powerpaste preview quickbars save searchreplace table tableofcontents template tinycomments tinydrive tinymcespellchecker typography visualblocks visualchars wordcount",
        toolbar1: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | indent outdent | wordcount | image link imagetools media insertfile',
        toolbar2: 'table tablecellprops tablecopyrow tablecutrow tabledelete tabledeletecol tabledeleterow tableinsertdialog tableinsertcolafter tableinsertcolbefore tableinsertrowafter tableinsertrowbefore tablemergecells tablepasterowafter tablepasterowbefore tableprops tablerowprops tablesplitcells tableclass tablecellclass tablecellvalign tablecellborderwidth tablecellborderstyle tablecaption tablecellbackgroundcolor tablecellbordercolor tablerowheader tablecolheader',

        tinycomments_mode: 'embedded',
        tinycomments_author: 'rmartel',
        tinycomments_author_name: 'Rosalina Martel',
        file_picker_callback: function(callback, value, meta) {
            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            let type = 'image' === meta.filetype ? 'Images' : 'Files',
                url = '/laravel-filemanager?editor=tinymce5&type=' + type;

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
