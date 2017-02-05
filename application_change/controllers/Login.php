<?php
class Login extends CI_Controller {

public function __construct() {
parent::__construct();
$this -> load -> model('get_userdata_models');
$this -> load -> helper('url_helper');
$this -> load -> library('encryption');
$this->load->library('session');
}

//	public function login_page()
//	{
//		//$data['ur'] = $this->news_model->get_user_data();
//		//$data['pw'] = $this->news_model->get_password_data();
//		$data['title'] = "Login";
//		$data['message'] = ' ';
//		//$data['errors'] = '';
//		//$data['login_data'] = $this->get_userdata_models->get_login_data();
//
//		$this->load->view('pages/login_page', $data);
//
//	}
public function index() {


		if(isset($_SESSION['loginfo']['uid']) && isset($_SESSION['loginfo']['username'])){
			
			$this -> load -> view('templates/tt');

		}else{
			$this->login_input();
		}


}

private function login_input (){
	//$data["from"]="login";
	try {
		//$this -> load -> helper(array('form', 'url'));

		$this -> load -> library('form_validation');

		$this -> form_validation -> set_rules('un', '用户名', 'trim|required|min_length[3]|max_length[16]|regex_match[/^[\w\@\#\$\%]+[ \·\w\@\#\$\%]+[\w\@\#\$\%]{2,17}$/]');
		$this -> form_validation -> set_rules('pw', '密码', 'required|min_length[6]|max_length[24]|regex_match[/^[ \w[:punct:]]{5,25}$/]');

		$this -> form_validation -> set_message('required', 'required');
		$this -> form_validation -> set_message('min_length', 'min_length');
		//需要设置多个属性
		$this -> form_validation -> set_message('max_length', 'max_length');
		$this -> form_validation -> set_message('regex_match', 'regex_match');

		if ($this -> form_validation -> run() == FALSE) 
		{

			if (validation_errors() != null) 
			{
				throw new Exception('请输入正确的用户名或密码.');
			} else {
				$data['message'] = '</br>';
			}
		//$this->load->view('head_file_in/login_style');
		$this -> load -> view('pages/login_page', $data);
		} else {


				//用户提交登录表单时执行如下代码
				$un = $this -> input -> post('un' );
				$pw = $this -> input -> post('pw');
			
		//				$setret_key = '05fd99b840ed3f125ac99967730d18a2';
		//				$encrypted = $result -> un_normal;
		//				/* 打开加密算法和模式 */
		//				$td = mcrypt_module_open(MCRYPT_CAST_256, '', MCRYPT_MODE_CFB, '');
		//
		//				/* 创建初始向量，并且检测密钥长度。 */
		//				$iv = substr($setret_key, 0, mcrypt_enc_get_iv_size($td));
		//				//mcrypt_enc_get_iv_size($td) = '16';
		//
		//				/* 创建密钥 */
		//				$key = $setret_key;
		//
		//				/* 初始化解密模块 */
		//				mcrypt_generic_init($td, $key, $iv);
		//
		//				/* 解密数据 */
		//				$decrypted = mdecrypt_generic($td, $encrypted);
		//
		//				if ($decrypted == $un) {
		//					/* 结束解密，执行清理工作，并且关闭模块 */
		//					mcrypt_generic_deinit($td);
		//					mcrypt_module_close($td);
		//				} else {
		//					throw new Exception('Is not find you！');
		//				}

		$this->encryption->initialize(//加密算法，模式，key配置。
		array(
		'cipher' => 'aes-256',
		'mode' => 'ecb',
		//'key' => $result -> string2,  //获取盐值2
		)
		);
		//$gr_un = 'qwer';
		//$un = $un.$gr_un;  //加入干扰字符，防止数据库泄漏后利用盐值破译密码
		$un = $this->encryption->encrypt($un);
		//加密
		//需要hash
		//$pw = password_hash($password, PASSWORD_DEFAULT); //哈希

		$result = $this -> get_userdata_models -> get_login_data($un);
		//查找数据库中有没有对应的用户
		if ($result == null )
		{
		throw new Exception('请输入正确的用户名或密码.');
		}

		//$salt = $result -> string;//调取数据库中的盐值
		//$pw = $pw . $salt;//加盐方式
		//$gr_pw = 'zxcv';
		//$pw = $pw.$salt.$gr_pw;

		$hash = $result -> pw_normal;//调取数据库的hash
		$salt = substr($hash,0,20) . substr($hash,73,strlen($hash));//抽取salt
		$pw = $pw . $salt;
		$hash = '$2y$11$' . substr($hash,20,53);//补齐hash
		
		if (password_verify($pw, $hash)) {	//解密hash，比对用户输入
			//通过则..
			$_SESSION['loginfo'] = array(
				'uid' => $result->id_num,
  				'username' => $result->un_normal,
  				'avatar' => $result->avatar_normal,
  				'nickname' => $result->nickname_normal
			);

            $home_url = 'http://'.$_SERVER['SERVER_NAME'].'/';
          //$back_url = base_url();
          	header('Location: '.$home_url);
		
		
		} else {
		throw new Exception('请输入正确的用户名或密码.');
		}

		//				if( $result > 0 ){
		//
		//					$this->load->view('pages/tt');//通过则调用
		//
		//				}else{
		//					throw new Exception ('Is not find you！');
		//				}
			
		}
	} catch(Exception $e) {
		$data['message'] = $e -> getMessage();
		$this -> load -> view('pages/login_page', $data);
		session_destroy();
	}
}







}//
?>