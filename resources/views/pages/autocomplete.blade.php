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

  <label for="autocomplete-input">Product:</label>
  <input type="text" id="autocomplete-input">
 
  <button id="insert-button" class="tox-button btn btn-primary">Insert</button>
  </div>
  </div>
</div>

<div class="d-none product-cart-box" id="form-template">
<form class="form-inline">
 
  <div class="form-check form-check-inline product-qty-box">
    <label id="product-name">Product:</label>
    <span>qty.</span>
    <div class="form-group qty-input">
        <input type="hidden" name="productId" id="productId"/>
        <input type="text" id="qty" name="qty" value="1" class="form-control">
    </div>
    <a href="javascript:void(0);"  onclick="addToCart(this)" class="primary-btn ccc">Add to cart</a>
   
  </div>
</form>

</div>
<script>

$(function() {
    $("#autocomplete-input").autocomplete({
        source: "{{ route('admin.pages.auto') }}",
        select: function( event, ui ) {
            event.preventDefault();
           // window.location = ui.item.url
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