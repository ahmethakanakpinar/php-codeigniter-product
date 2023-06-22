<?php
class Product_model extends MY_Model
{
    public $generalId;
    public function addProduct($productData)
    {
        $language = $this->product_model->get_all("product_language");
        foreach ($language as $count) {
            $generalData = array(
                "product_title"             => $productData["{$count->title}_product_title"],
                "language_id"               => "",
                "product_language"          => $count->id,
                "product_info_title"        => $productData["{$count->title}_product_info_title"],
                "product_info_description"  => $productData["{$count->title}_product_info_description"],
                "product_meta_title"        => $productData["{$count->title}_product_meta_title"],
                "product_meta_keywords"     => $productData["{$count->title}_product_meta_keywords"],
                "product_meta_description"  => $productData["{$count->title}_product_meta_description"],
                "product_seo_url"           => $productData["{$count->title}_product_seo_url"],
                "product_description"       => $productData["{$count->title}_product_description"],
                "product_video_embed"       => $productData["{$count->title}_product_video_embed"],
                "createdAt"                 => date("Y-m-d H:i:s")
            );
            $this->db->insert("product_general", $generalData);
        }
        $this->generalId = $this->db->insert_id()-1;
        $where = array("id" => $this->generalId);
        $data = array("language_id" => $this->generalId);
        $this->db->where($where)->update("product_general", $data);
        $where = array("id" => $this->generalId+1);
        $data = array("language_id" => $this->generalId);
        $this->db->where($where)->update("product_general", $data);
        $detailData = array(
            "product_id"            => $this->generalId,
            "product_code"          => $productData["product_code"],
            "product_amount"        => $productData["product_amount"],
            "product_tax"           => $productData["product_tax"],
            "product_second_tl"     => $productData["product_second_tl"],
            "product_dropoutstock"  => $productData["product_dropoutstock"],
            "isActive"              => $productData["isActive"],
            "product_properties"    => $productData["product_properties"],
            "product_validity"      => get_readable_date($productData["product_validity"]),
            "rank"                  => $productData["rank"],
            "homepage_rank"         => $productData["homepage_rank"],
            "new_product"           => $productData["new_product"],
            "product_installment"   => $productData["product_installment"],
            "guarantee"             => $productData["guarantee"]
        );
        $this->db->insert("product_detail", $detailData);

        $currencyData = array(
            "product_id"    => $this->generalId,
            "product_tl"    => $productData["product_tl"],
            "product_dolar" => $productData["product_dolar"],
            "product_euro"  => $productData["product_euro"]
        );
        $this->db->insert("product_currency", $currencyData);


        if($this->input->post("base64str[]") != "")
        {
            $base64strcount = count($_POST["base64str"]);
        
            for($i=0;$i<$base64strcount;$i++)
            {
                $image_name = time()."_".$i;
                $file_name = CharConvert($image_name). "." ."png";
                image_upload("new_form", $file_name, $i);
                $imageData = array(
                    "product_id"    => $this->generalId,
                    "img_url"       => $file_name,
                    "createdAt"     => date("Y-m-d H:i:s")
                );
                $product_image_model = $this->db->insert("product_images", $imageData);

                if(!$product_image_model)
                {
                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Fotoğraf Ekleme sırasında bir problem oluştu",
                        "type"  => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("{$this->viewTitle}"));
                    die();
                }
            }
        }

      
    }
   

    public function updateProduct($id = "", $productData = array(), $file_name = "")
    {

        $language = $this->product_model->get_all("product_language");
        foreach ($language as $count) {
            $generalData = array(
                "product_title"             => $productData["{$count->title}_product_title"],
                "language_id"               => $id,
                "product_language"          => $count->id,
                "product_info_title"        => $productData["{$count->title}_product_info_title"],
                "product_info_description"  => $productData["{$count->title}_product_info_description"],
                "product_meta_title"        => $productData["{$count->title}_product_meta_title"],
                "product_meta_keywords"     => $productData["{$count->title}_product_meta_keywords"],
                "product_meta_description"  => $productData["{$count->title}_product_meta_description"],
                "product_seo_url"           => $productData["{$count->title}_product_seo_url"],
                "product_description"       => $productData["{$count->title}_product_description"],
                "product_video_embed"       => $productData["{$count->title}_product_video_embed"],
            );
            $this->db->where("language_id", $id)->where("product_language", $count->id)->update("product_general", $generalData);
        }
        $detailData = array(
            "product_code"          => $productData["product_code"],
            "product_amount"        => $productData["product_amount"],
            "product_tax"           => $productData["product_tax"],
            "product_second_tl"     => $productData["product_second_tl"],
            "product_dropoutstock"  => $productData["product_dropoutstock"],
            "isActive"              => $productData["isActive"],
            "product_properties"    => $productData["product_properties"],
            "product_validity"      => get_readable_date($productData["product_validity"]),
            "rank"                  => $productData["rank"],
            "homepage_rank"         => $productData["homepage_rank"],
            "new_product"           => $productData["new_product"],
            "product_installment"   => $productData["product_installment"],
            "guarantee"             => $productData["guarantee"]
        );
        $this->db->where("product_id", $id)->update("product_detail", $detailData);

        $currencyData = array(
            "product_tl"    => $productData["product_tl"],
            "product_dolar" => $productData["product_dolar"],
            "product_euro"  => $productData["product_euro"]
        );
        $this->db->where("product_id", $id)->update("product_currency", $currencyData);

        if($this->input->post("base64str[]") != "")
        {
            $base64strcount = count($_POST["base64str"]);
        
            for($i=0;$i<$base64strcount;$i++)
            {
                $image_name = time()."_".$i;
                $file_name = CharConvert($image_name). "." ."png";
                image_upload("update_form", $file_name, $i);
                $imageData = array(
                    "product_id"    => $id,
                    "img_url"       => $file_name,
                    "createdAt"     => date("Y-m-d H:i:s")
                );
                $product_image_model = $this->db->insert("product_images", $imageData);

                if(!$product_image_model)
                {
                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Fotoğraf Ekleme sırasında bir problem oluştu",
                        "type"  => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("{$this->viewTitle}"));
                    die();
                }
            }
        }

    }
}
?>
