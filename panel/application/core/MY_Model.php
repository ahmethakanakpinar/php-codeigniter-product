<?php

class MY_Model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    //tüm kayıtları bura da getirecek olan method
    public function get_all($tableName = "", $where = array(), $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get($tableName)->result();
    }
    public function get_all_join($where = array())
    {
        $this->db->select('*');
        $this->db->select("product_general.id");
        $this->db->from("product_general");
        $this->db->join("product_detail", "product_general.language_id = product_detail.product_id", 'left');
        $this->db->join("product_images", "product_general.language_id = product_images.product_id", 'left');
        $this->db->join("product_currency", "product_general.language_id = product_currency.product_id", 'left');
        $this->db->where($where);
        $this->db->group_by("product_images.product_id");
        $results =  $this->db->get()->result();
        return $results;
    }
    public function get_all_join_id($where = array())
    {
        $t = &get_instance();
        $t->db->select('*');
        $t->db->select("product_general.id");
        $t->db->from("product_general");
        $t->db->join("product_detail", "product_general.language_id = product_detail.product_id", 'left');
        $t->db->join("product_images", "product_general.language_id = product_images.product_id", 'left');
        $t->db->join("product_currency", "product_general.language_id = product_currency.product_id", 'left');
        $t->db->where($where);
        $t->db->group_by("product_general.product_language");

      
        $results = $t->db->get()->result();
        return $results;
    }
    public function get($tableName = "", $where = array())
    {
        return $this->db->where($where)->get($tableName)->row();
    }
    public function delete($tableName = "", $where=array())
    {
        return $this->db->where($where)->delete($tableName);
    }
   
}

?>