<?php $image_upload = $this->session->userdata("image_upload"); ?>
<script>

window.addEventListener('DOMContentLoaded', function () {
		var image = document.getElementById('image');
		var input = document.getElementById('input');
		var $modal = $('#modal');
		var cropper;
		var image_cnt = 0;

		input.addEventListener('change', function (e) {
			var files = e.target.files;
			var reader;
			var file;
			var url;

			if (files && files.length > 0) {
				file = files[0];
				if (URL) {
					image.src = URL.createObjectURL(file);
					$modal.modal('show');
				} 
				else if (FileReader) 
				{
					reader = new FileReader();
					reader.onload = function (e) {
						image.src = reader.result;
						$modal.modal('show');
					};
					reader.readAsDataURL(file);
				}
			}
		});

		$modal.on('shown.bs.modal', function () {
			cropper = new Cropper(image, {
				aspectRatio: <?php echo $image_upload["image_aspect_ratio"] ?>,
				viewMode: 0,
			});
		}).on('hidden.bs.modal', function () {
			cropper.destroy();
			cropper = null;
		});

		document.getElementById('crop').addEventListener('click', function (image_width,image_height) {
                var canvas;
                $modal.modal('hide');
                if (cropper) {
                    canvas = cropper.getCroppedCanvas({
                        width:  <?php echo $image_upload["image_width"]; ?>,
                        height: <?php echo $image_upload["image_height"]; ?>,
                    });
					$("#image_crop_data").append('<div class="pad_row" id="image_cnt_'+image_cnt+'"><img class="image_upload_url" name="product_imagess" src="'+canvas.toDataURL()+'" style="margin-bottom:10px;"><a onclick="removeImage('+image_cnt+')" style="cursor: pointer; padding:20px; margin:20px; background-color:#f9c851; color:white; border-radius: 100%;">Sil</a><textarea name="base64str[]" style="opacity: 0;">'+canvas.toDataURL()+'</textarea></div>');
					image_cnt++;
                }
           
		});
		
		var frm = $('#imageForm1');
    frm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                console.log('Submission was successful.');
                console.log(data);
								$("#image_crop_data").html("");
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    });

});

	function removeImage(id)
	{
		$("#image_cnt_"+id).remove();
	}
	

</script>
<?php $this->session->unset_userdata("image_upload"); ?>