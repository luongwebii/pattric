@extends('layouts/contentNavbarLayout')

@section('title', 'Email - Create')



@section('content')
<style>

.dropify-wrapper .dropify-message p {
  font-size: initial;
}
</style>
    <div class="card mb-4">

        <h5 class="card-header">Add new Email.</h5>
    
        <div class="card-body">
            
        <form action="{{ route('emails.store') }}" method="POST" id="form" >
            @csrf

            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Subject</label>
                <input value="{{ old('subject') }}" 
                        type="text" 
                        class="form-control" 
                        name="subject" 
                         required>
                
                @if ($errors->has('subject'))
                    <span class="text-danger text-left">{{ $errors->first('subject') }}</span>
                @endif
            </div>

           
            <div class="mb-3 col-md-6">
                <label class="col-form-label">Body </label>
                <input type="hidden" value=" {{ old('body') }}" name="body" id="body" />
                <div id="editor"  class="form-control">
                {!! html_entity_decode(old('body')) !!}  
                </div>

             
                    
                    @if ($errors->has('body'))
                        <span class="text-danger text-left">{{ $errors->first('body') }}</span>
                    @endif
               
              
            </div>




            <button type="submit" class="btn btn-primary submit">Create Email</button>
        </form>
        </div>

    </div>

<script type="text/javascript">
     $(function() {
        var emailBodyConfig = {
            selector: '#editor',
            menubar: false,
            inline: true,
            plugins: [
                'link',
                'lists',
                'powerpaste',
                'autolink',
                'autoresize',
                'tinymcespellchecker'
            ],
            toolbar: [
                'undo redo | bold italic underline | fontselect fontsizeselect',
                'forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent'
            ],
            valid_elements: 'p[style],strong,em,span[style],a[href],ul,ol,li',
            valid_styles: {
                '*': 'font-size,font-family,color,text-decoration,text-align'
            },
            powerpaste_word_import: 'clean',
            powerpaste_html_import: 'clean',
        };
        tinymce.init(emailBodyConfig);

        $('.submit').click(function(e) {
            e.preventDefault();
            var myContent = tinymce.get("editor").getContent();
            $('#body').val(myContent);
            $("#form").submit();
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
}

</script>
@endsection
