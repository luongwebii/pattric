@extends('layouts/contentNavbarLayout')
@section('title')
Create static pages
@endsection

@section('content')
<style>
    .autocomplete-popup {
        position: absolute;
        top: 30px;
        left: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        z-index: 9999;
    }

    .autocomplete-popup ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .autocomplete-popup li {
        cursor: pointer;
        padding: 5px;
    }

    .autocomplete-popup li:hover {
        background-color: #f0f0f0;
    }
</style>
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3">Dashboard</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Page create</li>
            </ol>
        </nav>
    </div>
</div>
<form action="{{ isset($page->id) ? route('admin.pages.updatePage', $page->id) : route('admin.pages.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @isset($page->id)
    @method('PATCH')
    @endisset
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card radius-15 border-lg-top-info">
                <div class="card-header border-bottom-0 mb-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-lg-0">Create page</h5>
                        </div>
                        <div class="ml-auto">

                            <a class="btn btn-primary" href="{{ route('admin.pages') }}" data-toggle="tooltip" title="Back to pages &#9194;"><i class="bx bx-rewind"></i>Back</a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-form-label">Title</label>
                            <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" value="{{ $page->title ?? old('title') }}" placeholder="title" {{ !isset($page) ? 'required' : '' }}>
                            @error('title')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Excerpt</label>
                            <textarea name="excerpt" id="excerpt" class="form-control  @error('excerpt') is-invalid @enderror" placeholder="Short description">{{ $page->excerpt ?? old('excerpt') }}</textarea>
                            @error('excerpt')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Body</label>
                            <textarea name="body" id="body" class="form-control" rows="10" cols="70">{{ $page->body ?? old('body') }}</textarea>
                            @error('body')
                            <span class="text-danger" role="alert">
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
                <div class="card-header border-bottom-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Other information</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-form-label">Image</label>
                            <input type="file" name="image" class="dropify @error('image') is-invalid @enderror" data-max-file-size-preview="8M" @if (isset($page->image)) data-default-file="/{{ $page->image }}" @endif
                            {{ !isset($page->id) ? 'required' : '' }} />
                            @error('image')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Meta description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control  @error('title') is-invalid @enderror" placeholder="Meta description">{{ $page->meta_description ?? old('meta_description') }}</textarea>
                            @error('meta_description')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Meta keywords</label>
                            <textarea name="meta_keywords" id="meta_keywords" class="form-control  @error('meta_keywords') is-invalid @enderror" placeholder="Meta keywords">{{ $page->meta_keywords ?? old('meta_keywords') }}</textarea>
                            @error('meta_keywords')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="status" name="status" @isset($page->id)
                            {{ $page->status == 1 ? 'checked' : '' }}
                            @endisset
                            >
                            <label class="custom-control-label" for="status">Status</label>
                        </div>
                        <div class="float-right">
                            <div class="btn-group">
                                @if (isset($page->id))
                                <button type="submit" class="btn btn-primary px-2" data-toggle="tooltip" title="Update those data &#128190;"><i class="bx bx-task"></i> Update</button>
                                @else
                                <button type="submit" class="btn btn-primary px-4" data-toggle="tooltip" title="Save to database &#128190;"> <i class="bx bx-save"></i>Save</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    window.onload = function() {

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });


    }
    // toolbar: "aligncenter alignjustify alignleft alignnone alignright| anchor | blockquote blocks | backcolor | bold | copy | cut | fontfamily fontsize forecolor h1 h2 h3 h4 h5 h6 hr indent | italic | language | lineheight | newdocument | outdent | paste pastetext | print | redo | remove removeformat | selectall | strikethrough | styles | subscript superscript underline | undo | visualaid | a11ycheck advtablerownumbering typopgraphy anchor restoredraft casechange charmap checklist code codesample addcomment showcomments ltr rtl editimage fliph flipv imageoptions rotateleft rotateright emoticons export footnotes footnotesupdate formatpainter fullscreen help image insertdatetime link openlink unlink bullist numlist media mergetags mergetags_list nonbreaking pagebreak pageembed permanentpen preview quickimage quicklink quicktable cancel save searchreplace spellcheckdialog spellchecker | table tablecellprops tablecopyrow tablecutrow tabledelete tabledeletecol tabledeleterow tableinsertdialog tableinsertcolafter tableinsertcolbefore tableinsertrowafter tableinsertrowbefore tablemergecells tablepasterowafter tablepasterowbefore tableprops tablerowprops tablesplitcells tableclass tablecellclass tablecellvalign tablecellborderwidth tablecellborderstyle tablecaption tablecellbackgroundcolor tablecellbordercolor tablerowheader tablecolheader | tableofcontents tableofcontentsupdate | template typography | insertfile | visualblocks visualchars | wordcount",
    tinymce.init({
        selector: "#body",
        plugins: "a11ychecker advcode advlist advtable anchor autocorrect autolink autoresize autosave casechange charmap checklist code codesample directionality editimage emoticons export footnotes formatpainter fullscreen help image importcss inlinecss insertdatetime link linkchecker lists media mediaembed mentions mergetags nonbreaking pagebreak pageembed permanentpen powerpaste preview quickbars save searchreplace table tableofcontents template tinycomments tinydrive tinymcespellchecker typography visualblocks visualchars wordcount",
        toolbar1: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | indent outdent | wordcount | image link imagetools media insertfile',
        toolbar2: 'table tablecellprops tablecopyrow tablecutrow tabledelete tabledeletecol tabledeleterow tableinsertdialog tableinsertcolafter tableinsertcolbefore tableinsertrowafter tableinsertrowbefore tablemergecells tablepasterowafter tablepasterowbefore tableprops tablerowprops tablesplitcells tableclass tablecellclass tablecellvalign tablecellborderwidth tablecellborderstyle tablecaption tablecellbackgroundcolor tablecellbordercolor tablerowheader tablecolheader myCustomButton custom_button custom_button2',
        valid_elements : '*[*]',
        cleanup: false,
        allow_script_urls:true,
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
        },
        setup: function(editor) {
            // Add a custom button to the toolbar
            editor.ui.registry.addButton('custom_button', {
                text: 'Insert Product',
                onAction: function() {
                    // Function to open the popup

                    editor.windowManager.openUrl({
                        title: 'Insert Product',
                        url: "{{ route('page.autocomplete') }}",
                        height: 140,
                        width: 640,

                    });


                }
            });

            editor.ui.registry.addButton('custom_button2', {
                text: 'Insert Product Group',
                onAction: function() {
                    // Function to open the popup

                    editor.windowManager.openUrl({
                        title: 'Insert Product Group',
                        url: "{{ route('page.autocompleteGroups') }}",
                        height: 140,
                        width: 640,

                    });


                }
            });

        }
    });


    function openPopup() {
        // Create a popup element
        var popup = document.createElement('div');
        popup.className = 'autocomplete-popup';

        // Create an input element for user input
        var input = document.createElement('input');
        input.type = 'text';
        input.placeholder = 'Type to search...';
        input.addEventListener('input', handleInput);

        // Append the input element to the popup
        popup.appendChild(input);

        // Append the popup to the document body
        document.body.appendChild(popup);
    }

    function handleInput(event) {
        var userInput = event.target.value;

        // Make an AJAX request to fetch autocomplete suggestions
        fetch('autocomplete.php?input=' + userInput)
            .then(response => response.json())
            .then(data => {
                // Process the response and display the autocomplete suggestions
                console.log(data);
                displaySuggestions(data);
            })
            .catch(error => {
                // Handle any errors
            });
    }

    function displaySuggestions(suggestions) {
        // Get the popup element
        var popup = document.querySelector('.autocomplete-popup');

        // Clear previous suggestions
        popup.innerHTML = '';

        // Create a list element for suggestions
        var list = document.createElement('ul');

        // Create list items for each suggestion
        suggestions.forEach(function(suggestion) {
            var listItem = document.createElement('li');
            listItem.textContent = suggestion;
            listItem.addEventListener('click', handleSuggestionClick);
            list.appendChild(listItem);
        });

        // Append the list to the popup
        popup.appendChild(list);
    }

    function handleSuggestionClick(event) {
        var selectedSuggestion = event.target.textContent;

        // Do something with the selected suggestion
        console.log('Selected suggestion:', selectedSuggestion);

        // Close the popup
        var popup = document.querySelector('.autocomplete-popup');
        popup.remove();
    }
</script>

@endsection