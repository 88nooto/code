<?php
class Admin_models extends CI_Model {

    public function __construct()
    {
        $this->load->database('php_admin');
    }
	
	public function get_admin($admin)
	{
//		$where = "admin_user = '".$admin."' ORDER BY admin_uid";
//		$this->db->select('*');
//		$this->db->from('admin_data');
//		$this->db->where($where); // Produces: WHERE name = 'Joe' 
//		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$query =  $this->db->query("SELECT * FROM admin_data WHERE admin_user = '$admin' ORDER BY admin_uid DESC");
		$result = $query->row();
		return $result;
		
	}
	
	public function get_uid_and_admin($uid,$admin)
	{
//		$where = "admin_uid = '".$uid."' AND admin_user = '".$admin."'";
//		$this->db->select('*');
//		$this->db->from('admin_data');
//		$this->db->where($where); // Produces: WHERE name = 'Joe' 
//		$this->db->order_by('admin_uid ASC');
//		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$query =  $this->db->query("SELECT * FROM admin_data WHERE admin_uid = '$uid' AND admin_user = '$admin' ORDER BY admin_uid");
		$result = $query->row_array();
		return $result;
		
	}
	
	public function get_admin_data()
	{
//		//$where = "admin_user = '".$admin."'";
//		$this->db->select('*');
//		$this->db->from('admin_data');
//		//$this->db->where($where); // Produces: WHERE name = 'Joe' 
//		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$query =  $this->db->query("SELECT * FROM admin_data ORDER BY admin_uid ASC");
		$result = $query->result_array();
		return $result;
		
	}
	
	public function revise_admin_user_data($a_uid,$a_un,$a_power)
	{
		$where = "admin_uid = '".$a_uid."' AND admin_user = '".$a_un."'";
		$data = array('power' => $a_power);
		$str = $this->db->update('admin_data', $data, $where);
		
	}
	
	public function revise_admin_user_data_move($a_uid,$a_un,$a_power,$a_pw)
	{
		$where = "admin_uid = '".$a_uid."' AND admin_user = '".$a_un."'";
		$data = array('power' => $a_power, 'admin_pw' => $a_pw);
		$str = $this->db->update('admin_data', $data, $where);
		
	}


	public function inset_admin_user($a_un,$a_pw,$a_power)
	{
	
		$data = array(
			'admin_user' => $a_un, 
			'admin_pw' => $a_pw,
			'power' => $a_power,
			'c_time' => date("Y-m-d")
			);
		$this -> db -> insert('admin_data', $data);
		//return $data;
	}
	
	public function remove_admin_data($a_uid,$a_un)
	{
		$data = array(
			'admin_uid' => $a_uid,
			'admin_user' => $a_un
		);
		
		$this->db->delete('admin_data', $data);
	}
	
	public function save_ip_and_time($a_uid,$a_un,$ip)
	{
		$where = "admin_uid = '".$a_uid."' AND admin_user = '".$a_un."'";
		$data = array(
			'last_ip' => $ip, 
			'last_login' => date("Y-m-d")
			);
		$str = $this->db->update('admin_data', $data, $where);
	}
	
	public function get_keycode_data()//读取全部邀请码
	{
//		$this->db->select('*');
//		$this->db->from('keycode_data');
//		//$this->db->where($where); // Produces: WHERE name = 'Joe' 
//		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$query =  $this->db->query("SELECT * FROM keycode_data ORDER BY keydate_use DESC,keydate_create DESC");
		$result = $query->result_array();
		return $result;
	}
	
	public function get_keycode_data_not()//读取未使用邀请码
	{
//		$where = "state_code = '0'";
//		$this->db->select('*');
//		$this->db->from('keycode_data');
//		$this->db->where($where); // Produces: WHERE name = 'Joe' 
//		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$query =  $this->db->query("SELECT * FROM keycode_data WHERE state_code = '0' ORDER BY keydate_create DESC");
		$result = $query->result_array();
		return $result;
	}
	
	public function get_keycode_data_yes()//读取已使用邀请码
	{
//		$where = "state_code = '1'";
//		$this->db->select('*');
//		$this->db->from('keycode_data');
//		$this->db->where($where); // Produces: WHERE name = 'Joe' 
//		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$query =  $this->db->query("SELECT * FROM keycode_data WHERE state_code = '1' ORDER BY keydate_use DESC");
		$result = $query->result_array();
		return $result;
	}
	
	
	public function get_keycode_check($key)
	{
		$where = "key_code = '".$key."'";
		$this->db->select('*');
		$this->db->from('keycode_data');
		$this->db->where($where); // Produces: WHERE name = 'Joe' 
		$query = $this->db->get();  // Produces: SELECT id, nav_link, nav_name FROM nav
		$result = $query->result_array();
		return $result;
	}
	
	
	public function inset_keycode($keycode)
	{
		$data = array(
			'key_code' => $keycode, 
			'keydate_create' => date("Y-m-d")
			);
		$this -> db -> insert('keycode_data', $data);
		//return $data;
	}
	
	public function remove_keycode($keycode)
	{
		$data = array(
			'key_code' => $keycode
		);
		
		$this->db->delete('keycode_data', $data);
	}
	
}
?>