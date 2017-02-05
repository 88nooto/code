<?php
class Set_userdata_models extends CI_Model {

	public function __construct() {
		$this -> load -> database('set_user_data');
	}

	public function set_user_data($un,$pw,$email,$nn) {
		
		$data = array(
			'un_normal' => $un, 
			'pw_normal' => $pw,
			'email_normal' => $email,
			'nickname_normal' => $nn,
			'date_create' => date("Y-m-d")
			);
		$result = $this -> db -> insert('userdata_normal', $data);
		return $result;
	}

	public function set_keycode_data($keycode,$uid,$key_state) {
		
		
		$data = array(
			'uid_code' => $uid, 
			'state_code' => $key_state,
			'keydate_use' => date("Y-m-d")
			);

		$this -> db -> where('key_code',$keycode);
		$result = $this -> db -> update('keycode_data', $data);
		
		return $result;
	}

	public function get_uid_data($name){
		$where = "un_normal = '".$name."'";
		$this->db->select('id_num,un_normal');
		$this->db->from('userdata_normal');
		$this->db->where($where); // Produces: WHERE name = 'Joe' 
		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$result = $query->row();
		return $result;
	}
	
	
	public function new_keycode_data($keycode){
		$data = array(
			'key_code' => $keycode, 
			'keydate_create' => date("Y-m-d")
			);
		$result = $this -> db -> insert('userdata_normal', $data);
		return $result;
	}
}
?>