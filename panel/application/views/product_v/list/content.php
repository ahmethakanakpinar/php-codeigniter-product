<section class="app-content">
		<div class="row">
			<div class="col-md-12">
				<h4 class="m-b-lg">
                    Ürünler
                        <a class="btn btn-primary btn-outline pull-right btn-xs" href="<?php echo base_url("$viewTitle/new_form"); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Ekle</a>
                </h4>
			</div><!-- END column -->
			<div class="col-md-12">
				<div class="widget p-lg">
                    <?php if(empty($items)): ?>       
                        <div class="alert alert-info text-center">
                            <p>Burada herhangi bir veri bulunamamaktadır. Eklemek için <a href="<?php echo base_url("{$viewTitle}/new_form") ?>">Tıklayınız</a></p>
                        </div>
                    <?php else: ?>
                        <table class="table table-hover table-striped table-bordered content-container">
                            <thead>
                                <tr>
                                    <th class="w-100">
                                        <div class="">
                                            <div id="control-demo-6" class="">
                                                <select class="form-control language_select_list" > 
                                                    <?php foreach($product_language as $language): ?>   
                                                        <option <?php echo ($product_language_id == $language->id) ? "selected":"" ?> value="<?php echo $language->id ?>"><?php echo $language->title; ?></option>
                                                    <?php endforeach; ?> 
                                                </select>              
                                            </div>
                                        </div><!-- .form-group -->
                                    </th>
                                    <th>Resim</th>
                                    <th>Dil</th>
                                    <th>Seo Adresi</th>
                                    <th>Ürün Başlık</th>
                                    <th>Ürün Açıklama</th>
                                    <th>Fiyat</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php foreach($items as $item): ?> 
                                    <tr>
                                        <td style="text-align:center;"><i class="fa fa-reorder" aria-hidden="true"></i></td>
                                        <?php $img_resim = (empty($item->img_url)) ? base_url('assets')."/images/image-upload.jpg" : base_url('uploads')."/{$viewFolder}/$item->img_url" ; 
                                            $img_alt = (empty($item->img_url)) ?  "default" : $item->img_url; 
                                        ?> 
                                        <td style="text-align:center;"><img width="100" class="img-fluid img-rounded" src="<?php echo $img_resim; ?>" alt="<?php echo $img_alt;  ?>" ></td>
                                        <td><?php echo get_category_title($item->product_language, "add_model"); ?></td> 
                                        <td><?php echo $item->product_seo_url ?></td>    
                                        <td><?php echo $item->product_title ?></td> 
                                        <td><?php echo character_limiter(strip_tags($item->product_description),200) ?></td> 
                                        <td class="w-100" style="text-align:center;">                                       
                                            <div><?php echo $item->product_tl ?><label for="tl">₺</label></div>   
                                            <div><?php echo $item->product_dolar ?><label for="dolar">$</label></div>   
                                            <div><?php echo $item->product_euro ?><label for="euro">€</label></div>    
                                        </td>
                                        <td>       
                                            <button class="btn btn-danger btn-outline btn-sm remove-btn" data-url="<?php echo base_url("{$viewTitle}/delete/$item->language_id")?>"><i class="fa fa-trash" aria-hidden="true"></i> Sil</button>
                                            <a class="btn btn-info btn-outline btn-sm" href="<?php echo base_url("{$viewTitle}/new_form/$item->language_id")?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle</a>
                                        </td> 
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
             
				</div><!-- .widget -->
			</div><!-- END column -->
		</div><!-- .row -->
	</section><!-- #dash-content -->