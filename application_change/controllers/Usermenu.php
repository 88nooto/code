<?php
/**
 * PHP formatter...
 */
class Usermenu extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('get_userdata_models');
		$this -> load -> helper('url_helper');
		$this -> load -> library('encryption');
		$this -> load -> library('session');
	}

	public function index() {


		//使用一个会话变量检查登录状态
		if (isset($_SESSION['username'])) {
			$this -> load -> view('templates/tt');
			//echo 'You are Logged as ' . $_SESSION['username'] . '<br/>';
			//echo '<a href="logOut.php"> Log Out(' . $_SESSION['username'] . ')</a>';

		}else{
			$url = 'login';
        	header('Location: '.$url);
		}

		/**在已登录页面中，可以利用用户的session如$_SESSION['username']、
		 * $_SESSION['uid']对数据库进行查询，可以做好多好多事情*/
	}


	
	public function img_handle($img_path){
		//图像上传处理模块施工中
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'assets/images/avatar/'.$img_path.'.jpg';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']     = 40;
		$config['height']   = 40;

		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = 'assets/images/avatar/avatar_mask.png';
		$config['wm_opacity'] = 100;
		
		$this->load->library('image_lib', $config);
		
		if ( !$this->image_lib->resize() && !$this->image_lib->watermark() )
				{
    				echo $this->image_lib->display_errors('<p>', '</p>');
				}
		
		
	}
	


}//
?>