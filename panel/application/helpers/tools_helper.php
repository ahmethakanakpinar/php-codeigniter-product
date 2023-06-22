<?php

function CharConvert($string) {
    $search = array('ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü');
    $replace = array('c', 'C', 'g', 'G', 'i', 'I', 'o', 'O', 's', 'S', 'u', 'U');
    $string = str_replace($search, $replace, $string);
    $string = preg_replace('/[^a-zA-Z0-9]/', '-', $string);
    return  strtolower($string);
}

function get_readable_date($date)
{
    if(!empty($date))
    {
        $turkish_date = date('Y-m-d H:i:s', strtotime($date));
        return $turkish_date;
    }
}

function image_upload($turn,$img_name="", $i=0)
{
    $t = &get_instance();

        if(isset($t->username))
        {
            $img_path = "uploads/$t->viewFolder/$t->username/$img_name";
            $file_path = "uploads/$t->viewFolder/$t->username/";
        }
        else
        {
            $img_path = "uploads/$t->viewFolder/$img_name";
            $file_path = "uploads/$t->viewFolder/";
        }
        $img = $_POST["base64str"][$i];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace('data:image/jpg;base64,', '', $img);
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace('data:image/gif;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img_data = base64_decode($img);

        $im = imagecreatefromstring($img_data);
        if ($im !== false) {
            //header('Content-Type: image/png');
            imagesavealpha($im, true);
            imagepng($im, $img_path);
            imagedestroy($im);
        }
        else 
        {
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Görsel Yükleme de problem yaşandı!",
                "type" => "error"
            );
            $t->session->set_flashdata("alert", $alert);
            redirect(base_url("{$t->viewTitle}/$turn"));
            die();
        }
}

function dinamicjoin($table_name = "", $column_name = "", $second_column_name = "", $second_table_name = "", $third_table_name = "", $fourth_table_name = "" )
{
    $t = &get_instance();
    $t->db->select('*');
    $t->db->select($table_name . '.' . $column_name);
    $t->db->from($table_name);
    $t->db->join($second_table_name, $table_name . '.' . $column_name . ' = '. $second_table_name.'.' . $second_column_name, 'left');
    $t->db->join($third_table_name, $table_name . '.' . $column_name . ' = '. $third_table_name.'.' . $second_column_name, 'left');
    $t->db->join($fourth_table_name, $table_name . '.' . $column_name . ' = '. $fourth_table_name.'.' . $second_column_name, 'left');
    $t->db->group_by($third_table_name.'.' . $second_column_name);
    $results = $t->db->get()->result();
    return $results;
}

function dynamicJoinById($table_name = "", $column_name = "", $second_column_name = "", $second_table_name = "",  $third_table_name = "", $fourth_table_name = "", $id = "", $product_language = "", $product_language_id="")
{
    $t = &get_instance();
    $t->db->select('*');
    $t->db->select($table_name . '.' . $column_name);
    $t->db->from($table_name);
    $t->db->join($second_table_name, $table_name . '.' . $column_name . ' = '. $second_table_name.'.' . $second_column_name, 'left');
    $t->db->join($third_table_name, $table_name . '.' . $column_name . ' = '. $third_table_name.'.' . $second_column_name, 'left');
    $t->db->join($fourth_table_name, $table_name . '.' . $column_name . ' = '. $fourth_table_name.'.' . $second_column_name, 'left');
    $t->db->where($table_name . '.' . $column_name, $id);
    if(!empty($product_language_id))
        $t->db->where($table_name . '.' . $product_language, $product_language_id);
    $results = $t->db->get()->row();
    return $results;
}

function get_category_title($category_id = 0, $model="")
{
    $t = &get_instance();
    $t->load->model("product_model");
    $category = $t->product_model->get(
        "product_language",
        array(
            "id" => $category_id
        )
    );
    if($category)
        return $category->title;
    else
        return "<b class='text-danger'>Belirtilmedi</b>";        
}


function get_last_id($table_name) {
    $t = &get_instance();
    $t->db->select('id');
    $t->db->from($table_name);
    $t->db->order_by('id', 'desc');
    $t->db->limit(1);
    $query = $t->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->id;
    } else {
        return false;
    }
}



?>