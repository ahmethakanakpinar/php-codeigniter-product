<?php
class Product_model extends MY_Model
{
    public $generalId;
    public function addProduct($productData, $language = "1")
    {
        if ($language == "1") {
            $generalData = array(
                "product_title"             => $productData["product_title"],
                "product_language"          => $language,
                "product_info_title"        => $productData["product_info_title"],
                "product_info_description"  => $productData["product_info_description"],
                "product_meta_title"        => $productData["product_meta_title"],
                "product_meta_keywords"     => $productData["product_meta_keywords"],
                "product_meta_description"  => $productData["product_meta_description"],
                "product_seo_url"           => $productData["product_seo_url"],
                "product_description"       => $productData["product_description"],
                "product_video_embed"       => $productData["product_video_embed"],
                "createdAt"                 => date("Y-m-d H:i:s")
                
            );
            $this->db->insert("product_general", $generalData);
            $this->generalId = $this->db->insert_id();
            $where = array("id" => $this->generalId);
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


        }
        if ($language != "1") {
            $englishData = array(
                "product_title"             => $productData["en_product_title"],
                "language_id"               => $this->generalId,
                "product_language"          => $language,
                "product_info_title"        => $productData["en_product_info_title"],
                "product_info_description"  => $productData["en_product_info_description"],
                "product_meta_title"        => $productData["en_product_meta_title"],
                "product_meta_keywords"     => $productData["en_product_meta_keywords"],
                "product_meta_description"  => $productData["en_product_meta_description"],
                "product_seo_url"           => $productData["en_product_seo_url"],
                "product_description"       => $productData["en_product_description"],
                "product_video_embed"       => $productData["en_product_video_embed"],
                "createdAt"                 => date("Y-m-d H:i:s")
            );
            $this->db->insert("product_general", $englishData);
        }

    }
    public function addimage($file_name = "", $id = "")
    {
        $imageData = array(
            "product_id"    => !empty($id) ? $id : $this->generalId,
            "img_url"       => $file_name,
            "createdAt"     => date("Y-m-d H:i:s")
        );

        return $this->db->insert("product_images", $imageData);
    }

    public function updateProduct($id = "", $productData = array(), $language = "")
    {
        if ($language == "1") {
            $generalData = array(
                "product_title"             => $productData["product_title"],
                "language_id"               => $id,
                "product_language"          => $language,
                "product_info_title"        => $productData["product_info_title"],
                "product_info_description"  => $productData["product_info_description"],
                "product_meta_title"        => $productData["product_meta_title"],
                "product_meta_keywords"     => $productData["product_meta_keywords"],
                "product_meta_description"  => $productData["product_meta_description"],
                "product_seo_url"           => $productData["product_seo_url"],
                "product_description"       => $productData["product_description"],
                "product_video_embed"       => $productData["product_video_embed"],
                "createdAt"                 => date("Y-m-d H:i:s")
            );
            $this->db->where("language_id", $id)->where("product_language", $language)->update("product_general", $generalData);

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
        }
        else
        {
            $englishData = array(
                "product_title"             => $productData["en_product_title"],
                "language_id"               => $id,
                "product_language"          => $language,
                "product_info_title"        => $productData["en_product_info_title"],
                "product_info_description"  => $productData["en_product_info_description"],
                "product_meta_title"        => $productData["en_product_meta_title"],
                "product_meta_keywords"     => $productData["en_product_meta_keywords"],
                "product_meta_description"  => $productData["en_product_meta_description"],
                "product_seo_url"           => $productData["en_product_seo_url"],
                "product_description"       => $productData["en_product_description"],
                "product_video_embed"       => $productData["en_product_video_embed"],
                "createdAt"                 => date("Y-m-d H:i:s")
            );
            $this->db->where("language_id", $id)->where("product_language", $language)->update("product_general", $englishData);
        }
    }
}
?>
