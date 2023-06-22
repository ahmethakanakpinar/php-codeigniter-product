<?php
class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->viewTitle = "product";
		$this->viewFolder = "product_v";
		$this->load->model("product_model");
		$image_upload = array(
            "image_width" => 300,
            "image_height" => 300,
            "image_aspect_ratio" => 1/1
        );
        $this->session->set_flashdata("image_upload", $image_upload);
        $this->load->helper('text');
	}

	public function index($id = 1)
	{   
        $viewData = new stdClass();
        $items = $this->product_model->get_all_join(  
            array("product_language" => $id     
        ));                                    
        $viewData->items = $items;  
        $viewData->product_language_id = $id;   
		$viewData->viewTitle = $this->viewTitle; 
        $product_language = $this->product_model->get_all("product_language");   
		$viewData->product_language = $product_language; 
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list"; 
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}   
	public function new_form($id=0) 
	{   
        $items = $this->product_model->get_all_join_id(array("language_id" => $id,));
        $img_url = $this->product_model->get_all("product_images", array("product_id" => $id));
		$viewData = new stdClass();
        $product_tax = $this->product_model->get_all("product_tax"); 
		$viewData->product_tax = $product_tax; 
        $product_language = $this->product_model->get_all("product_language"); 
		$viewData->product_language = $product_language; 
		$viewData->viewTitle = $this->viewTitle;
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "addupdate";
        $viewData->items = $items;  
        $viewData->img_url = $img_url; 
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}  
  
	public function save()
    {   
        $this->load->library("form_validation");
        $this->form_validation->set_rules("TR_product_title", "Ürün Adı", "required|trim");
        $this->form_validation->set_rules("product_code", "Üründ Kodu", "required|trim");
        $this->form_validation->set_rules("product_amount", "Miktar", "required|trim");
        $this->form_validation->set_rules("product_tl", "TL Fiyatı", "required|trim");
        $this->form_validation->set_rules("rank", "Sıralama", "required|trim");
        $this->form_validation->set_rules("homepage_rank", "Anasayfa Sıralaması", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "{field} alanı doldurulmalıdır!"
            )
        );
        $validate = $this->form_validation->run();
        echo $validate;
        // $validate = true;
        if ($validate) {
          
            $productData = $_POST;
            $this->product_model->addProduct($productData);
            
            $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Kayıt başarılı bir şekilde eklendi",
                "type"  => "success"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("{$this->viewTitle}"));
        } 
        else {
            $viewData = new stdClass();
            $product_tax = $this->product_model->get_all("product_tax");
            $viewData->product_tax = $product_tax;
            $product_language = $this->product_model->get_all("product_language");
            $viewData->product_language = $product_language;
            $viewData->viewTitle = $this->viewTitle;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "addupdate";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

       
    }
  
    public function update($id)
    {
            $language = $this->product_model->get_all("product_language");
            $this->load->library("form_validation");
            $this->form_validation->set_rules("TR_product_title","Ürün Adı","required|trim");
            $this->form_validation->set_rules("product_code","Üründ Kodu","required|trim");
            $this->form_validation->set_rules("product_amount","Miktar","required|trim");
            $this->form_validation->set_rules("product_tl","TL Fiyatı","required|trim");
            $this->form_validation->set_rules("product_validity","Yeni Ürün geçerlilik süresi","required|trim");
            $this->form_validation->set_rules("rank","Sıralama","required|trim");
            $this->form_validation->set_rules("homepage_rank","Anasayfa Sıralaması","required|trim");
            $this->form_validation->set_message(
                array(
                    "required" => "{field} alanı doldurulmalıdır!"
                )
            );
            $validate = $this->form_validation->run();
            if($validate)
            {
                $productData = $_POST;
                $this->product_model->updateProduct($id, $productData);
                $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Kayıt başarılı bir şekilde eklendi",
                "type"  => "success"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("{$this->viewTitle}"));
            }
            else
            {
                $viewData = new stdClass();
                $product_tax = $this->product_model->get_all("product_tax");
                $viewData->product_tax = $product_tax;
                $product_language = $this->product_model->get_all("product_language");
                $viewData->product_language = $product_language;
                $viewData->viewTitle = $this->viewTitle;
                $viewData->viewFolder = $this->viewFolder;
                $viewData->subViewFolder = "addupdate";
                $viewData->form_error = true;
                $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
            }
    }

    

    public function delete($id)
    {
        $item = $this->product_model->get_all("product_images", array("product_id" => $id));
        $product_general_model = $this->product_model->delete("product_general", array("language_id" => $id));
        $product_detail_model = $this->product_model->delete("product_detail", array("product_id" => $id));
        $product_image_model = $this->product_model->delete("product_images", array("product_id" => $id));
        $product_currency_model = $this->product_model->delete("product_currency", array("product_id" => $id));
        if($product_general_model && $product_detail_model && $product_image_model && $product_currency_model)
        {
            $alert = array(
				"title" => "İşlem Başarılı",
				"text" => "Kayıt başarılı bir şekilde silindi",
				"type" => "success"
			);
            foreach($item as $images)
            {
                unlink("uploads/{$this->viewFolder}/$images->img_url");  //dosyayı belirli bir yoldan silmek için kullanılır.
            }
        }
        else
        {
            $alert = array(
				"title" => "İşlem Başarısız",
				"text" => "Kayıt silme işlemi sırasında bir problem oluştu!",
				"type" => "error"
			);
        }
        $this->session->set_flashdata("alert", $alert);
		redirect(base_url("$this->viewTitle"));
    }
    public function img_delete($id)
    {
        $this->product_model->delete("product_images", array("id" => $id));
    }
}