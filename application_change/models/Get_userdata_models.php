<?php
class Get_userdata_models extends CI_Model {

    public function __construct()
    {
        $this->load->database('user_server');
    }
	
	public function get_uid_data($uid){
		$where = "un_normal = '".$uid."'";
		$this->db->select('id_num,un_normal');
		$this->db->from('userdata_normal');
		$this->db->where($where); // Produces: WHERE name = 'Joe' 
		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$result = $query->row();
		return $result;
	}


	public function get_login_data($name)
	{
		//$from = "un_normal = '".$name."' and pw_normal = '".$pass."'";
		$where = "un_normal = '".$name."'";
		$this->db->select('*');
		$this->db->from('userdata_normal');
		$this->db->where($where); // Produces: WHERE name = 'Joe' 
		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$result = $query->row();
		return $result;
	}
	
	
	public function get_email_data($email){
		$where = "email_normal = '".$email."'";
		$this->db->select('email_normal');
		$this->db->from('userdata_normal');
		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	
	public function get_nickname_data($nickname){
		$where = "nickname_normal = '".$nickname."'";
		$this->db->select('nickname_normal');
		$this->db->from('userdata_normal');
		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function get_keycode_data($keycode){
		
		$where = "key_code = '".$keycode."'";
		$this->db->select('*');
		$this->db->from('keycode_data');
		$this->db->where($where); // Produces: WHERE name = 'Joe' 
		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$result = $query->row();
		return $result;
	}
	
	


}
?>