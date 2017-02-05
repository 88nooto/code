<?php
class Logout extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
		$this->load->library('session');
		
    }
	
	public function index(){
		$this -> logout();
	}
	
	private function logout() {

		//要清除会话变量，将$_SESSION超级全局变量设置为一个空数组
		$_SESSION = array();
		// 如果要清理的更彻底，那么同时删除会话 cookie
		// 注意：这样不但销毁了会话中的数据，还同时销毁了会话本身
		setcookie($session, NULL);

		// 最后，销毁会话
		session_unset();
		session_destroy();
		$url = 'http://'.$_SERVER['SERVER_NAME'].'/';
        header('Location: '.$url);
	}
}
?>