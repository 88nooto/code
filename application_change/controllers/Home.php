<?php
class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('get_userdata_models');
		$this -> load -> helper('url_helper');
		$this -> load -> library('encryption');
		$this -> load -> library('session');
	}
	
	
	public function index (){
		return null;
	}
	
	
//	public function home_get_userdata(){
//		
//		 
//		$this->encryption->initialize(//加密算法，模式，key配置。
//		array(
//		'cipher' => 'aes-256',
//		'mode' => 'ecb',
//		//'key' => $result -> string2,  //获取盐值2
//		)
//		);
//		
//		
//		if (isset($_SESSION['username'])) {
//				
//				$avatar_img = 'assets/images/avatar/'.$_SESSION['uid'].'/'.$_SESSION['avatar'].'.png';
//				$avatar_img = '<a href="usermenu"><img src = "'.$avatar_img.'" style= "width:34px;height:34px;border-radius:34px;margin-bottom:5px; vertical-align:middle;"/></a>';
//				
//				//读取头像
//				
//				
//				//$_SESSION['username'] = $a
//				$username = $this->encryption->decrypt($_SESSION['username']);
//				
//				$hpud = '<a href="usermenu" class="navigation-link" style= "">'.$_SESSION['nickname'].'</a><a href="logout" style= ""> Log Out</a>';
//				
//				//echo $ava;
//				echo $avatar_img.$hpud;
//		}else {
//				$hpud = '
//		<a href="login" class="navigation-link" >
//			登陆
//		</a>/
//		<a href="register" class="navigation-link">
//			注册
//		</a>
//				';
//				echo $hpud;
//		}
//	}
	
	
	
}
?>