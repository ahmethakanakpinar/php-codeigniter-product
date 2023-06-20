<script>
    var deleteolacak = [];
    var base_url = "<?php echo base_url('product/img_delete/'); ?>";


      $(".language_select_list").change(function(){
        var selectedValue = $(this).val();
        window.location.href = "<?php echo base_url('product/index/') ?>" + selectedValue;
        $(this).val(selectedValue);
      });

      
      $(".delete_image").on('click', function() {
        var imgId = $(this).data("img");
        $("#" + imgId).remove();
        deleteolacak.push(imgId);
        
      });
     

      $("#update_button").on('click', function(event) {
          var deletelength = deleteolacak.length;
          for (var i = 0; i < deletelength; i++) {
            url = base_url + deleteolacak[i];
            $.ajax({
                url: url,
                method: "POST",
                success: function(response) {
                    // Başarılı işlem sonrası yapılacak işlemler
                },
                error: function() {
                    // Hata durumunda yapılacak işlemler
                }
            });
          }
      });
  

</script>