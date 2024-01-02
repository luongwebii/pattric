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
    .autocomplete-suggestions {
        border: 1px solid #999;
        background: #FFF;
        overflow: auto;
    }

    .autocomplete-suggestion {
        padding: 2px 5px;
        white-space: nowrap;
        overflow: hidden;
    }

    .autocomplete-selected {
        background: #F0F0F0;
    }

    /*.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }*/
    .autocomplete-group {
        padding: 2px 5px;
    }

    .autocomplete-group strong {
        display: block;
        border-bottom: 1px solid #000;
    }
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
    <form>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <h2  id="product-name">product options and order form</h2>
            </div>
        </div>
        <section id="examples" class="order-form-product-list-table ">
            <!-- content -->
            <div id="content-8" class="content">

                <table class="table  table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Model</th>
                            <th scope="col">Price</th>
                            <th scope="col">buy qty.</th>
                            <th scope="col">drawing</th>
                            <th scope="col">orient.</th>
                            <th scope="col">area SM</th>
                            <th scope="col">bottom butter.</th>
                            <th scope="col">racking butter.</th>


                        </tr>
                    </thead>
                    <tbody class="group-content">

                        <tr>
                           
                        </tr>

                    </tbody>
                </table>
            </div>
        </section>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="add-cart-box">
                    <a href="javascript:void(0);" onclick="addToCartGroup(this)" class="primary-btn">Add to cart</a>
                </div>
            </div>
        </div>
    </form>
    </div>




    <script>

        $(function () {
            $("#autocomplete-input").autocomplete({
                source: "{{ route('admin.pages.auto-group') }}",
                select: function (event, ui) {
                    event.preventDefault();

                    $('#product-group').html(ui.item.value);
                    var optionHtml = "";
                    for (score of ui.item.products) {

                        optionHtml += "<tr>";
                        optionHtml += `
                            <td>${score.model}</td>
                            <td>${score.price}</td>
                            <td>
                                <div class="form-group qty-input">
                                <input type="hidden" name="productIds[]" value="${score.id}" id="productId"/>
                                    <input type="text" class="form-control	" name="qtys[]" value="1" placeholder="0" id="qty">
                                </div>
                            </td>
                            <td class="dra-link"><a href="#">${score.drawing}</a></td>
                            <td>${score.orient}</td>
                            <td>${score.area_sm}</td>
                            <td>${score.bottom_butter}</td>
                            <td>${score.racking_butter}</td>

                               `;
                               optionHtml += "</tr>";
                    }
                  
                    //console.log(optionHtml);
                    $('.group-content').html(optionHtml);
                    $("#autocomplete-input").val(ui.item.value);

                }
            });
        });

        // Add an event listener to the "Insert" button
        document.getElementById('insert-button').addEventListener('click', function () {
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