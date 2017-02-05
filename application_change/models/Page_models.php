<?php
class Page_models extends CI_Model {

    public function __construct()
    {
        $this->load->database('get_nav_data');
    }
	


public function get_nav_data(){

	$id="id = '1'";
	$this->db->select('nav_link,nav_name,id_nav');
	$this->db->from('nav');
	$this->db->where($id); // Produces: WHERE name = 'Joe' 
	$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
	return $query->result_array();
}

public function get_nav_down_data(){

	$id="id = '2'";
	$this->db->select('*');
	$this->db->from('nav');
	$this->db->where($id); // Produces: WHERE name = 'Joe' 
	$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
	return $query->result_array();
}


public function get_header_data($header_num){

	//$tb_name = "'logo_img,".$page_name."_img'";
	$this->db->select('*');
	$this->db->from('header');
	//$this->db->where($id); // Produces: WHERE name = 'Joe' 
	$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
	return $query->row_array($header_num);
}




}
?>