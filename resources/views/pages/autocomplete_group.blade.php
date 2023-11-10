<!DOCTYPE html>
<html>
<head>
  <title>Autocomplete Popup</title>
 <!-- jQuery library -->
   <!-- Include Styles -->
@include('layouts/sections/styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

</head>
{{--custom css item suggest search--}}
<style>
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    /*.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }*/
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>
<body>
<div class="row">
<div class="col-12">
<div class="form-inline mt-2 px-4">

  <label for="autocomplete-input">Product Group:</label>
  <input type="text" id="autocomplete-input">
 
  <button id="insert-button" class="tox-button btn btn-primary">Insert</button>
  </div>
  </div>
</div>

<div class="d-none" id="form-template">
<form class="form-inline">
 
  <div class="form-check form-check-inline">
    <label id="product-group">Product Group:</label>
    <div class="group-content"></div>
  </div>
</form>

</div>
<script>

$(function() {
    $("#autocomplete-input").autocomplete({
        source: "{{ route('admin.pages.auto-group') }}",
        select: function( event, ui ) {
            event.preventDefault();

            $('#product-group').html(ui.item.value);
            var optionHtml = "<table>";
            for (score of ui.item.products) {
              
                optionHtml += "<tr><td>";
                optionHtml +=  `<form class="form-inline">
                                <div class="form-check form-check-inline">
                                <label id="product-name">${score.name}:</label>
                                <input type="hidden" name="productIds[]" value="${score.id}" />
                                <input type="text" id="qty" name="qtys[]" value="1" class="form-control1">
                                <button id="add-button" class="btn btn-primary">Add To Cart</button>
                                </div>
                                </div>`;
                optionHtml += "</td></tr>";
            }
            optionHtml += "</table>";
            //console.log(optionHtml);
            $('.group-content').html(optionHtml);
            $("#autocomplete-input").val(ui.item.value);

        }
    });
});

  // Add an event listener to the "Insert" button
  document.getElementById('insert-button').addEventListener('click', function() {
    // Call the function to insert content into the editor
    insertContent();
  });
</script>
<script>
    function closePopup() {
  // Close the popup window

  
  window.close();
}
function insertContent() {
  // Retrieve the content to be inserted
  var content = $('#form-template').html();

  window.parent.postMessage({
  mceAction: 'insertContent',
  content: content
}, '*');
window.parent.postMessage({ mceAction: 'close' });
}
    

</script>
  <script>
    // Implement the autocomplete functionality using your preferred library
    // Configure the autocomplete to retrieve suggestions via AJAX based on your data source
    // Here's an example using jQuery UI Autocomplete library
   
  </script>
</body>
</html>