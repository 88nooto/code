<?php

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this -> load -> model('get_userdata_models');
		//$this -> load -> model('set_userdata_models');
		$this -> load -> helper('url_helper');
		$this -> load -> library('encryption');

	}

	public function index() {
		try {

			$this -> load -> library('form_validation');
			//is_unique无效，需要调试
			$this -> form_validation -> set_rules('un', '用户名', 'trim|required|min_length[3]|max_length[16]|regex_match[/^[\w\@\#\$\%]+[ \·\w\@\#\$\%]+[\w\@\#\$\%]{2,17}$/]');
			$this -> form_validation -> set_rules('psw', '密码', 'required|min_length[6]|max_length[24]|regex_match[/^[ \w[:punct:]]{5,25}$/]');
			$this -> form_validation -> set_rules('pw', '确认密码', 'required|min_length[6]|max_length[24]|matches[psw]|regex_match[/^[ \w[:punct:]]{5,25}$/]');
			$this -> form_validation -> set_rules('email', 'Email', 'trim|required|min_length[8]|max_length[20]|valid_email|regex_match[/^[ \w[:punct:]]{5,25}$/]');
			$this -> form_validation -> set_rules('nickname', '昵称', 'trim|required|min_length[3]|max_length[20]|regex_match[/^[\x{4e00}-\x{9fa5}A-Za-z0-9_\~\!\@\#\?\.\·]+$/u]');  //错误：中文正则表达式在PHP中有所变化，(已修复)
			$this -> form_validation -> set_rules('keycode', '邀请码', 'trim|required|exact_length[24]|alpha_numeric');//邀请码模块未完成

			$this -> form_validation -> set_message('required', '{field},required');
			$this -> form_validation -> set_message('min_length', '{field},min_length');
			//需要设置多个属性
			$this -> form_validation -> set_message('max_length', '{field},max_length');
			$this -> form_validation -> set_message('regex_match', '{field},regex_match');

			$this -> form_validation -> set_message('is_unique', '{field},is_unique');
			$this -> form_validation -> set_message('matches', '{field},matches');
			$this -> form_validation -> set_message('valid_email', '{field},valid_email');
			$this -> form_validation -> set_message('exact_length', '{field},exact_length');
			$this -> form_validation -> set_message('alpha_numeric', '{field},alpha_numeric');

			if ($this -> form_validation -> run() == FALSE) {

				if (validation_errors() != null) {
					//throw new Exception('请输入正确的用户名或密码.');
					$data['message'] = validation_errors();
				} else {
					$data['message'] = '</br>';
				}

				$this -> load -> view('pages/register_page',$data);
			} else {

				//$data['message'] = '';
				//$this -> load -> view('pages/register_page',$data);

				$un = $this -> input -> post('un');
				$psw = $this -> input -> post('psw');
				$pw = $this -> input -> post('pw');
				$email = $this -> input -> post('email');
				$nickname = $this -> input -> post('nickname');
				$keycode = $this -> input -> post('keycode');
				
				//加密配置
				$this->encryption->initialize(//加密算法，模式，key配置。
				array(
					'cipher' => 'aes-256',
					'mode' => 'ecb',
					)
				);
				
				//加密用户名
				$ciphertext = $this->encryption->encrypt($un);
				
				//判断
				$username = $this -> get_userdata_models -> get_login_data($ciphertext);  //查询数用户名在数据库中是否存在
				if($username != NULL){
					throw new Exception('用户已存在.');
				}
				
				if($psw === $pw){
					$pw = $this -> password_hash($pw);
				}else{
					throw new Exception('两次的密码输入不一样.');
				}
				
				$email_num = $this -> get_userdata_models -> get_email_data($email);
				if(count($email_num) > 3){
					throw new Exception('这个邮箱已经成RBQ啦，换一个吧.');
				}
				
				
				$nickname_num = $this -> get_userdata_models -> get_nickname_data($nickname);
				if(count($nickname_num) > 0){
					throw new Exception('昵称已存在.');
				}
				
				$kc = $this -> get_userdata_models -> get_keycode_data($keycode);
				if($kc == NULL || $kc->state_code != 0 ){
					throw new Exception('邀请码已使用或不存在.');
				}
				

				
				//插入数据库
				$un = $ciphertext;
				$pw = $pw;
				$email = $email;
				$nickname = $nickname;
				$keycode = $keycode;
				$key_state = $kc->state_code + 1;
				
				$this->db->close('get_userdata_models');			//连接多个数据库时，不支持多用户切换，所以得手动关闭重新连接。
				$this -> load -> model('set_userdata_models');
				
				$result = $this->set_userdata_models->set_user_data($un,$pw,$email,$nickname);
				
				if(!$result ){
					throw new Exception('error,please try again.');
				}

				$get_uid = $this -> set_userdata_models -> get_uid_data($un);
				$uid = $get_uid->id_num;
				
				$set_key_uid = $this->set_userdata_models->set_keycode_data($keycode,$uid,$key_state);
				
				if(!$set_key_uid){
					throw new Exception('error,please try again...');
				}else{
					
				//解密用户名
				$un = $this->encryption->decrypt($un);
					
				$password = $this -> input -> post('psw');
				
				
				//调用成功页面	
				
				$data['register_data'] = array('Uid'=>$uid,'用户名'=>$un,'密码'=>$pw,'Email'=>$email,'昵称'=>$nickname,'邀请码'=>$keycode);
				
				
				if(!is_dir('assets/images/avatar/'.$uid)){//判断用户头像文件夹是否存在
					mkdir('assets/images/avatar/'.$uid);//不存在就创建一个
					copy('assets/images/def.png','assets/images/avatar/'.$uid.'/def.png');//拷贝默认头像
					copy('assets/images/def.png','assets/images/avatar/'.$uid.'/def_thumb.png');//拷贝默认头像缩略图
					clearstatcache();//清除函数缓存
				}
				if(!is_dir('assets/userfile/'.$uid)){//判断用户文件文件夹是否存在
					mkdir('assets/userfile/'.$uid);//不存在就创建一个
					
					//写入信息
					$message = '信息就是：没有信息。';
					file_put_contents('assets/userfile/'.$uid.'/message.txt',$message,FILE_APPEND);
				}
				
				
				$this -> load -> view('pages/register_success',$data);
				//注册成功提示页，返回主页。


				}
			}
		} catch(Exception $e) {
			$data['message'] = $e -> getMessage();
			$this -> load -> view('pages/register_page', $data);
		}

	}

	private function password_hash($pw){
		$num = random_int(16,24);
		$bytes = bin2hex(random_bytes($num));
		$pw = $pw.$bytes;
		$options = [
		    		'cost' => 11,
		];
		$ph = password_hash($pw, PASSWORD_DEFAULT,$options);
		$ph = substr($ph,7,strlen($ph));	//去掉hash统一前缀

		$ph = substr($bytes, 0,20).$ph.substr($bytes, 20,strlen($bytes));	//hash与salt混编
		return $ph;
		
	}

}
?>