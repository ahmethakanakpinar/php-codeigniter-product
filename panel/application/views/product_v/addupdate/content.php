<?php 
	if(isset($items))
	{
		foreach($items as $item)
		{
			if($item->product_language == 1)
			{
				$item1= $item;
			}
			else if($item->product_language == 2)
			{
				$item2 = $item;
			}
		}
	}
?>
<section class="app-content">
		<div class="row">
			<div class="col-md-12">
				<h4 class="m-b-lg">
					<?php if(isset($item1)): ?>
						<?php echo " <b>$item1->product_title</b> Kaydını Düzenliyorsunuz" ?> 
					<?php else: ?>
						Ürün Ekle
					<?php endif; ?>
                </h4>
			</div><!-- END column -->
			<div class="col-md-12">
				<?php if(isset($item1)): ?>
					<form action="<?php echo base_url("{$viewTitle}/update/$item1->language_id") ?>" method="post" enctype = "multipart/form-data">
				<?php else: ?>
					<form action="<?php echo base_url("{$viewTitle}/save") ?>" method="post" enctype = "multipart/form-data">
				<?php endif; ?>
						<div class="widget p-lg">
							<div class="m-b-lg nav-tabs-horizontal">
								<!-- tabs list -->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" id="genel" class="active"><a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">Genel</a></li>
									<li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Detaylar</a></li>
									<li role="presentation"><a href="#tab-3"  aria-controls="tab-3" role="tab" data-toggle="tab">Resimler</a></li>
									<li role="presentation"><a href="#tab-4"  aria-controls="tab-4" role="tab" data-toggle="tab">İndirim</a></li>
									<li style="float: right;">
										<div class="form-group ">
											<div id="control-demo-6" class="">
												<select data-id="<?php echo isset($item->language_id) ? $item->language_id:""; ?>" class="form-control language_select <?php echo isset($item->language_id) ?"language_select_get":"" ?>" name="product_language" >
													<?php foreach($product_language as $language): ?>
														<option <?php echo isset($form_error) ? ((set_value("product_language") == $language->id) ? "selected":"") : (false ? (($language_id == $language->id) ? "selected":"") : "") ?>  value="<?php echo $language->id ?>"><?php echo $language->title; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div><!-- .form-group -->
									</li>
								</ul><!-- .nav-tabs -->
								<!-- Tab panes -->
								<div class="tab-content p-md">
								
													
											<div role="tabpanel" class="tab-pane in active fade tr_container" id="tab-1">
												<div class="row">
													<div class="col-md-6 form-group <?php echo (isset($form_error) ? (empty(set_value("product_title")) ? "has-error" :"") : "") ?>" >
														<label for="product_title"><span class="text-danger">*</span>Türkçe Ürün Başlık</label>
														<input type="text" class="form-control" id="product_title" name="product_title" value="<?php echo isset($form_error) ? set_value("product_title") : ((isset($item1->product_title)) ? $item1->product_title : "") ?>">
														<?php if(isset($form_error)): ?>
														<small class="text-danger"><?php echo form_error("product_title"); ?></small>
														<?php endif; ?>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group" >
														<label for="product_info_title">Türkçe Ürün Ek Bilgi Başlığı</label>
														<input type="text" class="form-control" id="product_info_title" name="product_info_title" value="<?php echo isset($form_error) ? set_value("product_info_title") : ((isset($item1->product_info_title)) ? $item1->product_info_title : "") ?>">
													
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group " >
														<label for="product_info_description">Türkçe Ürün Ek Bilgi Açıklaması</label>
														<input type="text" class="form-control" id="product_info_description" name="product_info_description" value="<?php echo isset($form_error) ? set_value("product_info_description") : ((isset($item1->product_info_description)) ? $item1->product_info_description : "") ?>">
														
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group" >
														<label for="product_meta_title">Türkçe Meta Title</label>
														<input type="text" class="form-control" id="product_meta_title" name="product_meta_title" value="<?php echo isset($form_error) ? set_value("product_meta_title") : ((isset($item1->product_meta_title)) ? $item1->product_meta_title : "") ?>">
													
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group " >
														<label for="product_meta_keywords">Türkçe Meta Keywords</label>
														<input type="text" class="form-control" id="product_meta_keywords" name="product_meta_keywords" value="<?php echo isset($form_error) ? set_value("product_meta_keywords") : ((isset($item1->product_meta_keywords)) ? $item1->product_meta_keywords : "") ?>">
													
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group " >
														<label for="product_meta_description">Türkçe Meta Description</label>
														<input type="text" class="form-control" id="product_meta_description" name="product_meta_description" value="<?php echo isset($form_error) ? set_value("product_meta_description") : ((isset($item1->product_meta_description)) ? $item1->product_meta_description : "") ?>">
													
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group " >
														<label for="product_seo_url">Türkçe Seo Adresi</label>
														<input type="text" class="form-control" id="product_seo_url" name="product_seo_url" value="<?php echo isset($form_error) ? set_value("product_seo_url") : ((isset($item1->product_seo_url)) ? $item1->product_seo_url : "") ?>">
													
													</div>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Türkçe Ürün Açıklama</label>
													<textarea name="product_description" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo isset($form_error) ? set_value("product_description") : ((isset($item1->product_description)) ? $item1->product_description : "") ?></textarea>
												</div>
												<div class="row">
													<div class="col-md-12 form-group " >
														<label for="product_video_embed">Türkçe Video Embed Kodu</label>
														<input type="text" class="form-control" id="product_video_embed" name="product_video_embed" value="<?php echo isset($form_error) ? set_value("product_video_embed") : ((isset($item1->product_video_embed)) ? $item1->product_video_embed : "") ?>">
													
													</div>
												</div>
											</div><!-- .tab-pane  -->
											<div role="tabpanel" class="tab-pane fade en_container" id="tab-1">
												<div class="row">
													<div class="col-md-6 form-group <?php echo (isset($form_error) ? (empty(set_value("product_title")) ? "has-error" :"") : "") ?>" >
														<label for="en_product_title"><span class="text-danger">*</span>Türkçe Ürün Başlık</label>
														<input type="text" class="form-control" id="en_product_title" name="en_product_title" value="<?php echo isset($form_error) ? set_value("en_product_title") : ((isset($item2->product_title)) ? $item2->product_title : "") ?>">
														<?php if(isset($form_error)): ?>
														<small class="text-danger"><?php echo form_error("en_product_title"); ?></small>
														<?php endif; ?>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group" >
														<label for="en_product_info_title">Türkçe Ürün Ek Bilgi Başlığı</label>
														<input type="text" class="form-control" id="en_product_info_title" name="en_product_info_title" value="<?php echo isset($form_error) ? set_value("en_product_info_title") : ((isset($item2->product_info_title)) ? $item2->product_info_title : "") ?>">
													
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group " >
														<label for="en_product_info_description">Türkçe Ürün Ek Bilgi Açıklaması</label>
														<input type="text" class="form-control" id="en_product_info_description" name="en_product_info_description" value="<?php echo isset($form_error) ? set_value("en_product_info_description") : ((isset($item2->product_info_description)) ? $item2->product_info_description : "") ?>">
														
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group" >
														<label for="en_product_meta_title">Türkçe Meta Title</label>
														<input type="text" class="form-control" id="en_product_meta_title" name="en_product_meta_title" value="<?php echo isset($form_error) ? set_value("en_product_meta_title") : ((isset($item2->product_meta_title)) ? $item2->product_meta_title : "") ?>">
													
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group " >
														<label for="en_product_meta_keywords">Türkçe Meta Keywords</label>
														<input type="text" class="form-control" id="en_product_meta_keywords" name="en_product_meta_keywords" value="<?php echo isset($form_error) ? set_value("en_product_meta_keywords") : ((isset($item2->product_meta_keywords)) ? $item2->product_meta_keywords : "") ?>">
													
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group " >
														<label for="en_product_meta_description">Türkçe Meta Description</label>
														<input type="text" class="form-control" id="en_product_meta_description" name="en_product_meta_description" value="<?php echo isset($form_error) ? set_value("en_product_meta_description") : ((isset($item2->product_meta_description)) ? $item2->product_meta_description : "") ?>">
													
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group " >
														<label for="en_product_seo_url">Türkçe Seo Adresi</label>
														<input type="text" class="form-control" id="en_product_seo_url" name="en_product_seo_url" value="<?php echo isset($form_error) ? set_value("en_product_seo_url") : ((isset($item2->product_seo_url)) ? $item2->product_seo_url : "") ?>">
													
													</div>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Türkçe Ürün Açıklama</label>
													<textarea name="en_product_description" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo isset($form_error) ? set_value("en_product_description") : ((isset($item2->product_description)) ? $item2->product_description : "") ?></textarea>
												</div>
												<div class="row">
													<div class="col-md-12 form-group " >
														<label for="en_product_video_embed">Türkçe Video Embed Kodu</label>
														<input type="text" class="form-control" id="en_product_video_embed" name="en_product_video_embed" value="<?php echo isset($form_error) ? set_value("en_product_video_embed") : ((isset($item2->product_video_embed)) ? $item2->product_video_embed : "") ?>">
													
													</div>
												</div>
											</div><!-- .tab-pane  -->
								
									<div role="tabpanel" class="tab-pane fade" id="tab-2">
										<div class="row">
											<div class="col-md-6 form-group <?php echo (isset($form_error) ? (empty(set_value("product_code")) ? "has-error" :"") : "") ?>" >
												<label for="product_code"><span class="text-danger">*</span>Ürün Kodu</label>
												<input type="text" class="form-control" id="product_code" name="product_code" value="<?php echo isset($form_error) ? set_value("product_code") : (isset($item->product_code) ? $item->product_code : "") ?>">
												<?php if(isset($form_error)): ?>
												<small class="text-danger"><?php echo form_error("product_code"); ?></small>
												<?php endif; ?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 form-group <?php echo (isset($form_error) ? (empty(set_value("product_amount")) ? "has-error" :"") : "") ?>" >
												<label for="product_amount"><span class="text-danger">*</span>Miktar</label>
												<input type="text" class="form-control" id="product_amount" name="product_amount" value="<?php echo isset($form_error) ? set_value("product_amount") : (isset($item->product_amount) ? $item->product_amount : "") ?>">
												<?php if(isset($form_error)): ?>
												<small class="text-danger"><?php echo form_error("product_amount"); ?></small>
												<?php endif; ?>
											</div>
										</div>
										<div class="form-group ">
											<label for="control-demo-6" class=""><span class="text-danger">*</span>Sepette Ekstra İndirim</label>
											<div id="control-demo-6" class="">
												<select class="form-control" name="news_type">
													<option value="0">0</option>
												</select>
											</div>
										</div><!-- .form-group -->
										<div class="form-group ">
											<label for="control-demo-6" class=""><span class="text-danger">*</span>Vergi Oranı</label>
											<div id="control-demo-6" class="">
												<select class="form-control" name="product_tax" >
													<?php foreach($product_tax as $tax): ?>
														<option <?php echo isset($form_error) ? ((set_value("product_tax") == $tax->product_tax) ? "selected":"") : (isset($item->product_tax) ? (($item->product_tax == $tax->product_tax) ? "selected":"") : "") ?>  value="<?php echo $tax->product_tax ?>"><?php echo $tax->product_tax; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div><!-- .form-group -->
										<div class="row">
											<div class="col-md-6 form-group" >
												<label ><span class="text-danger">*</span>Satış Fiyatı</label>
												<div class="row">
													<div class="col-md-2">
														<input type="text" class="form-control <?php echo (isset($form_error) ? (empty(set_value("product_tl")) ? "has-error" :"") : "") ?>" style="margin-bottom:10px" id="product_tl" name="product_tl" value="<?php echo isset($form_error) ? set_value("product_tl") : (isset($item->product_tl) ? $item->product_tl : "") ?>">
														<?php if(isset($form_error)): ?>
														<small class="text-danger"><?php echo form_error("product_tl"); ?></small>
														<?php endif; ?>
													</div>
													<label class="col-md-10" for="product_tl">TL</label>
												</div>
												<div class="row">
													<div class="col-md-2">
														<input type="text" class="form-control <?php echo (isset($form_error) ? (empty(set_value("product_dolar")) ? "has-error" :"") : "") ?>" style="margin-bottom:10px" id="product_dolar" name="product_dolar" value="<?php echo isset($form_error) ? set_value("product_dolar") : (isset($item->product_dolar) ? $item->product_dolar : "") ?>">
														<?php if(isset($form_error)): ?>
														<small class="text-danger"><?php echo form_error("product_dolar"); ?></small>
														<?php endif; ?>
													</div>
													<label class="col-md-10" for="product_dolar">$</label>
												</div>
												<div class="row">
													<div class="col-md-2">
														<input type="text" class="form-control <?php echo (isset($form_error) ? (empty(set_value("product_euro")) ? "has-error" :"") : "") ?>" style="margin-bottom:10px" id="product_euro" name="product_euro" value="<?php echo isset($form_error) ? set_value("product_euro") : (isset($item->product_euro) ? $item->product_euro : "") ?>">
														<?php if(isset($form_error)): ?>
														<small class="text-danger"><?php echo form_error("product_euro"); ?></small>
														<?php endif; ?>
													</div>
													<label class="col-md-10" for="product_euro">€</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 form-group" >
												<label for="product_second_tl"><span class="text-danger">*</span>2. satış fiyatı</label>
												<input type="text" class="form-control" id="product_second_tl" name="product_second_tl" value="<?php echo isset($form_error) ? set_value("product_second_tl") : (isset($item->product_second_tl) ? $item->product_second_tl : "") ?>">
											
											</div>
										</div>
										<div class="form-group ">
											<label for="control-demo-6" class=""><span class="text-danger">*</span>Stoktan Düş</label>
											<div id="control-demo-6" class="">
												<select class="form-control" name="product_dropoutstock" >
													<option <?php echo isset($form_error) ? ((set_value("product_dropoutstock") == 1) ? "selected":"") : (isset($item->product_dropoutstock) ? (($item->product_dropoutstock == 1) ? "selected" : ""): "") ?> value="1">Evet</option>
													<option <?php echo isset($form_error) ? ((set_value("product_dropoutstock") == 0) ? "selected":"") : (isset($item->product_dropoutstock) ? (($item->product_dropoutstock == 0) ? "selected" : ""): "") ?> value="0">Hayır</option>
												</select>
											</div>
										</div><!-- .form-group -->
										<div class="form-group ">
											<label for="control-demo-6" class=""><span class="text-danger">*</span>Durum</label>
											<div id="control-demo-6" class="">
												<select class="form-control" name="isActive">
												<option <?php echo isset($form_error) ? ((set_value("isActive") == 1) ? "selected":"") : (isset($item->isActive) ? (($item->isActive == 1) ? "selected" : ""): "") ?> value="1">Açık</option>
												<option <?php echo isset($form_error) ? ((set_value("isActive") == 0) ? "selected":"") : (isset($item->isActive) ? (($item->isActive == 0) ? "selected" : ""): "") ?> value="0">Kapalı</option>
												</select>
											</div>
										</div><!-- .form-group -->
										<div class="form-group ">
											<label for="control-demo-6" class=""><span class="text-danger">*</span>Özellik Bölümü</label>
											<div id="control-demo-6" class="">
												<select class="form-control" name="product_properties" >
													<option <?php echo isset($form_error) ? ((set_value("product_properties") == 1) ? "selected":"") : (isset($item->product_properties) ? (($item->product_properties == 1) ? "selected" : ""): "") ?> value="1">Göster</option>
													<option <?php echo isset($form_error) ? ((set_value("product_properties") == 0) ? "selected":"") : (isset($item->product_properties) ? (($item->product_properties == 0) ? "selected" : ""): "") ?> value="0">Gösterme</option>
												</select>
											</div>
										</div><!-- .form-group -->
										<div class="form-group" style="position: relative;">
											<label for="product_validity"><span class="text-danger">*</span>Yeni Ürün Geçerlilik Süresi</label>
											<input type="text" id="product_validity" name="product_validity" class="form-control" data-plugin="datetimepicker" data-options="{  viewMode: 'days', format : 'YYYY-MM-DD HH:mm:ss'}" value="<?php echo isset($form_error) ? set_value("product_validity") : (isset($item->product_validity) ? $item->product_validity : "") ?>">
											<!-- data-options="{ defaultDate: '3/27/2016' }" -->
										</div><!-- .form-group -->
										<div class="row">
											<div class="col-md-6 form-group <?php echo (isset($form_error) ? (empty(set_value("rank")) ? "has-error" :"") : "") ?>" >
												<label for="rank"><span class="text-danger">*</span>Sıralama</label>
												<input type="text" class="form-control" id="rank" name="rank" value="<?php echo isset($form_error) ? set_value("rank") : (isset($item->rank) ? $item->rank : "") ?>">
												<?php if(isset($form_error)): ?>
												<small class="text-danger"><?php echo form_error("rank"); ?></small>
												<?php endif; ?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 form-group <?php echo (isset($form_error) ? (empty(set_value("homepage_rank")) ? "has-error" :"") : "") ?>" >
												<label for="homepage_rank"><span class="text-danger">*</span>Anasayfada Göster</label>
												<input type="text" class="form-control" id="homepage_rank" name="homepage_rank" value="<?php echo isset($form_error) ? set_value("homepage_rank") : (isset($item->homepage_rank) ? $item->homepage_rank : "") ?>">
												<?php if(isset($form_error)): ?>
												<small class="text-danger"><?php echo form_error("homepage_rank"); ?></small>
												<?php endif; ?>
											</div>
										</div>
										<div class="form-group ">
											<label for="control-demo-6" class=""><span class="text-danger">*</span>Yeni Ürün</label>
											<div id="control-demo-6" class="">
												<select class="form-control" name="new_product" >
												<option <?php echo isset($form_error) ? ((set_value("new_product") == 1) ? "selected":"") : (isset($item->new_product) ? (($item->new_product == 1) ? "selected" : ""): "") ?> value="1">Evet</option>
												<option <?php echo isset($form_error) ? ((set_value("new_product") == 0) ? "selected":"") : (isset($item->new_product) ? (($item->new_product == 0) ? "selected" : ""): "") ?> value="0">Hayır</option>
												</select>
											</div>
										</div><!-- .form-group -->
										<div class="form-group ">
											<label for="control-demo-6" class=""><span class="text-danger">*</span>Taksit</label>
											<div id="control-demo-6" class="">
												<select class="form-control" name="product_installment" >
												<option <?php echo isset($form_error) ? ((set_value("product_installment") == 1) ? "selected":"") : (isset($item->product_installment) ? (($item->product_installment == 1) ? "selected" : ""): "") ?> value="1">Evet</option>
												<option <?php echo isset($form_error) ? ((set_value("product_installment") == 0) ? "selected":"") : (isset($item->product_installment) ? (($item->product_installment == 0) ? "selected" : ""): "") ?> value="0">Hayır</option>
												</select>
											</div>
										</div><!-- .form-group -->
										<div class="row">
											<div class="col-md-6 form-group" >
												<label for="guarantee">Garanti Süresi</label>
												<input type="text" class="form-control" id="guarantee" name="guarantee" value="<?php echo isset($form_error) ? set_value("guarantee") : (isset($item->guarantee) ? $item->guarantee : "") ?>">
											</div>
										</div>
									</div><!-- .tab-pane  -->
									<div role="tabpanel" class="tab-pane fade" id="tab-3">
										<div class="form-group image_upload_container" >
											<label for="exampleInputFile">Ürün Ana Resmi</label>
											<div class="row">
												<div class="col-md-1">
													<label class="label" data-toggle="tooltip" title="Resim yükleyin">
														
														<?php if(!isset($form_error)): ?>
															<img class="" src="<?php echo base_url("assets") ?>/images/image-upload.jpg" alt="Resim Seçiniz" style="cursor:pointer">
															<input type="file" id="input" class="sr-only" name="img_url" accept="image/*" >
														<?php else: ?>
															<img class="" src="<?php echo base_url("assets") ?>/images/image-upload.jpg" alt="Resim Seçiniz" style="cursor:pointer">
															<input type="file" id="input" class="sr-only" name="img_url" accept="image/*" >
														<?php endif;?>
													</label>
												</div>
												<div class="col-md-11">
													<?php if(isset($item->img_url)): ?>
														<?php foreach($img_url as $item_images): ?>
															<?php $img_resim = (empty($item->img_url)) ? base_url('assets')."/images/image-upload.jpg" : base_url('uploads')."/{$viewFolder}/$item_images->img_url" ; 
																$img_alt = (empty($item->img_url)) ?  "default" : $item->img_url; 
																$substring = strstr($item_images->img_url, '.', true);
															?>
															<div class="pad_row" id="<?php echo $item_images->id ?>"><img style="margin-bottom:10px" class="image_upload_url" src="<?php echo $img_resim; ?>"><a class="delete_image" data-img="<?php echo $item_images->id ?>" style="cursor: pointer; padding:20px; margin:20px; background-color:#f9c851; color:white; border-radius: 100%;">Sil</a></div>
														<?php endforeach; ?>
													<?php endif; ?>
													<?php if(isset($form_error)): ?>
														<div>
															<?php $i = 0;?>
															<?php if(isset($_POST["base64str"])): ?>
															<?php $base64strcount = ($_POST["base64str"]); ?>
																<?php foreach($base64strcount as $sa): ?>
																	<div class="pad_row" id="<?php echo $i ?>"><img style="margin-bottom:10px" class="image_upload_url" src="<?php echo $sa ?>"><a class="delete_image" data-img="<?php echo $i ?>" style="cursor: pointer; padding:20px; margin:20px; background-color:#f9c851; color:white; border-radius: 100%;">Sil</a><textarea name="base64str[]" style="opacity: 0;"><?php echo $sa; ?></textarea></div>
																	<?php $i++;?>
																<?php endforeach; ?>
															<?php endif;?>
														</div>
													
													<?php endif; ?>
													<div id="image_crop_data">
													</div>
												</div>
											</div>
										</div><!-- .form-group -->
									</div><!-- .tab-pane  -->
									<div role="tabpanel" class="tab-pane fade" id="tab-4">
										<div class="col-md-12">
												<table class="table table-responsive">
													<thead>
														<tr><th>Müşteri Grubu</th><th>Öncelik</th><th>Yüzde İndirim Oranı veya İndirimli Fiyatı</th><th>Başlangıç Tarihi</th><th>Bitiş Tarihi</th></tr>
													</thead>
													<tr>
														<td>
															<div class="form-group ">
																<label for="control-demo-6" class="">Özellik Bölümü</label>
																<div id="control-demo-6" class="">
																	<select class="form-control" name="news_type" >
																		<option value="image">Müşteri</option>
																	</select>
																</div>
															</div><!-- .form-group -->
														</td>
														<td>
															<input type="text" class="form-control" id="oncelik" name="oncelik" >
														</td>
														<td>
															<div class="row">
																<div class="col-md-12 form-group" >
																	<div class="row">
																		<div class="col-md-8">
																			<input type="text" class="form-control" style="margin-bottom:10px" id="product_discount_tl" name="product_discount_tl" >
																		</div>
																		<label class="col-md-4" for="product_discount_tl">TL</label>
																	</div>
																	<div class="row">
																		<div class="form-group col-md-8">
																			<div id="control-demo-4" class="">
																				<select class="form-control" name="news_type" >
																					<option value="image">Fiyat</option>
																				</select>
																			</div>
																		</div><!-- .form-group -->
																	</div>
																	<div class="row">
																		<div class="col-md-8">
																			<input type="text" class="form-control" style="margin-bottom:10px" id="product_discount_dolar" name="product_discount_dolar" >
																		</div>
																		<label class="col-md-4" for="product_discount_dolar">$</label>
																	</div>
																	<div class="row">
																		<div class="form-group col-md-8">
																			<div id="control-demo-4" class="">
																				<select class="form-control" name="news_type" >
																					<option value="image">Fiyat</option>
																				</select>
																			</div>
																		</div><!-- .form-group -->
																	</div>
																	<div class="row">
																		<div class="col-md-8">
																			<input type="text" class="form-control" style="margin-bottom:10px" id="product_discount_euro" name="product_discount_euro" >
																		</div>
																		<label class="col-md-4" for="product_discount_euro">€</label>
																	</div>
																	<div class="row">
																		<div class="form-group col-md-8">
																			<div id="control-demo-4" class="">
																				<select class="form-control" name="news_type" >
																					<option value="image">Fiyat</option>
																				</select>
																			</div>
																		</div><!-- .form-group -->
																	</div>
																</div>
															</div>
														</td>
														<td>
															<input type="text" class="form-control" id="start_date" name="start_date" >
															
														</td>
														<td>
															<input type="text" class="form-control" id="finish_date" name="finish_date" >
															
														</td>
													</tr>
												</table>
												<br>
												<button type="submit" class="btn btn-primary btn-md btn-outline" style="float:right">İndirim Ekle</button>
										</div><!-- END column -->
									</div><!-- .tab-pane  -->
								</div><!-- .tab-content  -->
								<!-- MODEL POPUP -->
									<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="modalLabel">Resimi Kırp</h5>
												<p class="modal-title" id="modalLabel">Mouse tekerleği ile resmi büyültüp küçültebilirsiniz.</p>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="img-container">
												<img id="image" src="">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
												<button type="button" class="btn btn-primary" id="crop">Kırp</button>
											</div>
											</div>
										</div>
									</div>
								<!-- MODEL POPUP -->
							</div><!-- .nav-tabs-horizontal -->
							<button id="update_button" type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
							<a href="<?php echo base_url("{$viewTitle}") ?>" class="btn btn-danger btn-md btn-outline">İptal</a>
						</div><!-- .widget -->
					</form>
			</div><!-- END column -->
		</div><!-- .row -->
	</section><!-- #dash-content -->
