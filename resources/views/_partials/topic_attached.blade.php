<div class="clone hide" style="display:none;">
    <div class="control-group input-group" style="margin-top:10px">
        <input type="text" name="file_name[]" class="form-control w-20" placeholder="Name">
        <input type="file" name="file_path[]" class="form-control w-50">
        <input type="text" name="order_image[]" class="form-control w-10" placeholder="Order">
        <span class="input-group-text"></span>
        <input type="hidden" name="order_image_id[]">
        <div class="input-group-btn">
            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

    $("body").on("click",".btn-success",function(){ 
  
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
    });

    function addRow() {
        var elem = document.id('attachment').clone().inject(document.id('more_attachments'));
        elem.getElement('.cancel').setStyle('visibility', 'visible');
        elem.getElement('.cancel').addEvent('click', function(evt) {
            this.getParent('div').dispose();
        });
        elem.getElements('input').each(function(ele, i) {
            if (ele.get('name') !== null) {
                next_id++;
                var next_name = ele.get('name').replace('[0]', '[' + next_id + ']');
                ele.set('name', next_name);
            }
        });
        return false;


    }
</script>