<?php
class Admin extends CI_Controller 
{

	public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_models');
        $this->load->helper('url_helper');
		$this->load->library('encryption');
		$this->load->library('session');
    }
	
	public function index() 
	{
		
//		if(isset($_SESSION['loginfo']['uid']) && isset($_SESSION['loginfo']['username'])){
//			
//			$this -> admin_ctrl();
//		}else{
//			$this -> login_input();
//		}
			
		try{
			//$log = $this -> login_test('normal');
			if($this -> login_test('normal')){
				$data['url'] = base_url().'admin/admin_ctrl';				
				$this->load->view('templates/loading', $data);
			}else{
				$this -> login_input();
			}
		
			} catch(Exception $e) {
				echo "error";
				session_destroy();
		}
	}
	
	private function login_test($test_function)
	{
		
		switch ($test_function)
		{
			case 'normal':
				if(isset($_SESSION['loginfo']['a_uid']) && isset($_SESSION['loginfo']['a_un']))
				{
					return TRUE;
				}else{
					return FALSE;
				}
			break;
			case 'ajax':
				
				if(isset($_SESSION['loginfo']['a_uid']) && isset($_SESSION['loginfo']['a_un']) && $this->input->is_ajax_request())
				{
					return TRUE;
				}else{
					return FALSE;
				}
			break;
			default:
				return 'error';
		}
		

	}
	
	private function power_test()
	{
		$result = $this -> admin_models -> get_uid_and_admin($_SESSION['loginfo']['a_uid'],$_SESSION['loginfo']['a_un']);
		return $result['power'];
	}
	
	public function logout() 
	{

		//要清除会话变量，将$_SESSION超级全局变量设置为一个空数组
		$_SESSION = array();
		// 如果要清理的更彻底，那么同时删除会话 cookie
		// 注意：这样不但销毁了会话中的数据，还同时销毁了会话本身
		setcookie($session, NULL);

		// 最后，销毁会话
		session_unset();
		session_destroy();
//		$url = 'http://'.$_SERVER['SERVER_NAME'].'/';
//      header('Location: '.$url);
		$backurl = base_url().'admin';
      	header('Location: '.$backurl);
	}
	
		
	private function login_input ()
	{
		//$data["from"]="admin";
	try 
	{
		
		$this -> load -> library('form_validation');

		$this -> form_validation -> set_rules('un', '用户名', 'trim|required|min_length[3]|max_length[16]|regex_match[/^[\w\@\#\$\%]+[ \·\w\@\#\$\%]+[\w\@\#\$\%]{2,17}$/]');
		$this -> form_validation -> set_rules('pw', '密码', 'required|min_length[5]|max_length[24]|regex_match[/^[ \w[:punct:]]{5,25}$/]');

		$this -> form_validation -> set_message('required', 'required');
		$this -> form_validation -> set_message('min_length', 'min_length');
		//需要设置多个属性
		$this -> form_validation -> set_message('max_length', 'max_length');
		$this -> form_validation -> set_message('regex_match', 'regex_match');

		if ($this -> form_validation -> run() == FALSE) 
		{

			if (validation_errors() != null) 
			{
				throw new Exception('请输入正确的用户名或密码.0');
			} else {
				$data['message'] = '</br>';
			}
		$this->load->view('head_file_in/admin_style');
		$this -> load -> view('pages/login_page', $data);
		} else {


				//用户提交登录表单时执行如下代码
				$un = $this -> input -> post('un' );
				$pw = $this -> input -> post('pw');
				
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

		$result = $this -> admin_models -> get_admin($un);
		//查找数据库中有没有对应的用户
		if (empty($result))
		{
		throw new Exception('请输入正确的用户名或密码.1');
		}

		//$salt = $result -> string;//调取数据库中的盐值
		//$pw = $pw . $salt;//加盐方式
		//$gr_pw = 'zxcv';
		//$pw = $pw.$salt.$gr_pw;

		$hash = $result -> admin_pw;//调取数据库的hash
		$salt = substr($hash,0,20) . substr($hash,73,strlen($hash));//抽取salt
		$pw = $pw . $salt;
		$hash = '$2y$11$' . substr($hash,20,53);//补齐hash
		
		if (password_verify($pw, $hash)) {	//解密hash，比对用户输入
		//通过则..------------------------------------------------------------------

		$_SESSION['loginfo'] = array(
			'a_uid' => $result->admin_uid,
  			'a_un' => $result->admin_user,
		);
		$this->session->mark_as_temp(array(
			$_SESSION['loginfo']['a_uid'] => 300,
			$_SESSION['loginfo']['a_un']  => 300
		));
				//$back_url = 'http://'.$_SERVER['SERVER_NAME'].'/admin';
//        		$back_url = base_url().'/admin';
//        		header('Location: '.$back_url);
		
		$this->admin_models->save_ip_and_time($result->admin_uid,$result->admin_user,$this->input->ip_address());		
		//每次登陆更新ip和时间
		$data['url'] = base_url().'admin/admin_ctrl';
		$this->load->view('templates/loading', $data);
		//---------------------------------------------------------------------------
		} else {
		throw new Exception('请输入正确的用户名或密码.2');
		}
		
		}
		} catch(Exception $e) {
		$data['message'] = $e -> getMessage();
		//$this -> load -> view('pages/login_page', $data);
		//session_destroy();
		}
	}
	

	public function admin_ctrl ()
	{
	  try{
		
			//$log = $this -> login_test('normal');
			if(!$this -> login_test('normal')){
				throw new Exception('登陆超时，请重新登录。2');
			}
			
//			}else{
//				$back_url = base_url().'admin/menu';
//        		header('Location: '.$back_url);
			
		$a_nav = array(
			"admin"=>array(
				"menu","user manage","web manage","reg code"
			),
			"user"=>array(
				"menu","web manage","reg code"
			),
			"temp"=>array(
				"menu","reg code"
			),
		);
		
		$a_nav2 = array(
			"admin2"=>array(
				"menu","user","web","code"
			),
			"user2"=>array(
				"menu","web","code"
			),
			"temp2"=>array(
				"menu","code"
			),
		);
			
		
		//$admin_array = array_combine($a_nav["admin"],$a_nav2["admin2"]);	//合并两个数组，一个为键名一个为键值；
		//$result = $this -> admin_models -> get_admin($_SESSION['a_un']);
		$result = $this -> admin_models -> get_admin($_SESSION['loginfo']['a_un']);
		$power=$result->power;
		switch ($power)
		{  
			case "1":
				$data['l_nav'] = array_combine($a_nav["admin"],$a_nav2["admin2"]);
				break;
			case "2":
				$data['l_nav'] = array_combine($a_nav["user"],$a_nav2["user2"]);
				break;
			case "3":
				$data['l_nav'] = array_combine($a_nav["temp"],$a_nav2["temp2"]);
				break;
			default:
				$this -> logout();
		}
		
		$this->load->view('head_file_in/admin_style');
		$this->load->view('pages/admin_page', $data);
	  }catch(Exception $e) {
	  	echo $e->getMessage();
	  	//echo '</br><a href="/logout"> Log Out</a>';
	  	session_destroy();
		//$backurl = $_SERVER['HTTP_HOST'].'/admin';
		$backurl = base_url().'admin';
        header('Location: '.$backurl);
	  }
	
		
	}


	public function admin_data_ctrl ($admin_page_rdiv)
	{
		
	try{
		
		
		if($this -> login_test('ajax')){
			$result = $this -> admin_models -> get_admin($_SESSION['loginfo']['a_un']);
			if(!isset($result))
			{
				throw new Exception('404');
			}
		}else{
			throw new Exception('404');
		}
		

		$power = $result -> power;
		switch ($power){
			case "1":
			switch ($admin_page_rdiv){
			case "menu":
				$this -> get_admin_menu_data();
			continue;
			case "user":
				$this -> get_admin_user_data();
			continue;
			case "web":
				$this -> get_admin_web_data();
			continue;
			case "code":
				$this -> get_admin_keycode_data();
			continue;
			default:
			echo "can't getting data.";
			};
			break;
			case "2":
			switch ($admin_page_rdiv){
			case "menu":
				$this -> get_admin_menu_data();
			continue;
			case "user":
				$this -> get_admin_user_data();
			continue;
			case "web":
				$this -> get_admin_web_data();
			continue;
			default:
			echo "can't getting data.";
			};
			break;
			case "3":
			switch ($admin_page_rdiv){
			case "menu":
				$this -> get_admin_menu_data();
			continue;
			case "web":
				$this -> get_admin_web_data();
			continue;
			default:
			echo "can't getting data.";
			};
			break;
			default:
			echo "登录超时或权限不足，请重新登录。";
		}
		

			//$this->load->view('templates/', $data);
	  }catch(Exception $e) {
		echo $e -> getMessage();
		session_destroy();
	  }
	}

	private function get_admin_menu_data()
	{
		echo "admin menu data";
		
		
		
	}
	
	private function get_admin_user_data()
	{
		//echo "admin user data";
		
		$data['admin_user'] = $this -> admin_models -> get_admin_data();
		$data['tr_class'] = array("","success","warning","info");//列表样式
		$this->load->view('templates/admin_user_manage',$data);
	}
	
	private function get_admin_web_data()
	{
		echo "admin web data";
	}
	
	private function get_admin_keycode_data()
	{
		$data['tr_class'] = array("","success","warning","info");//列表样式
		$data['keycode_data'] = $this -> admin_models -> get_keycode_data();
		$this->load->view('templates/keycode_page.php',$data);
	}







	public function revise_admin_user_data()
	{
	try{
			if(!$this->login_test('ajax'))
			{
				throw new Exception('error, please try again.');
			}else if($this->power_test()!=1)
			{
				throw new Exception('error, please try again.');
			}
			
			$get_uid = $this->input->post('uid');
			$get_user = $this->input->post('user');
			
			$rule_uid = '/[0-9]+/';
			$rele_user = '/^[\w\@\#\$\%]+[ \·\w\@\#\$\%]+[\w\@\#\$\%]{2,17}$/';
			preg_match_all($rule_uid,$get_uid,$uid,PREG_PATTERN_ORDER);
			preg_match_all($rele_user,$get_user,$user,PREG_PATTERN_ORDER);
			
			
			
			if (isset($uid[0]) && isset($user[0])) 
			{
				$revise_uid = $uid[0][0];
				$revise_user = $user[0][0];
				
			}elseif (validation_errors() != null) 
			{
					throw new Exception('请输入正确的用户名或密码.raud');
			}
			
			
			
			
			
		$this->encryption->initialize(//加密算法，模式，key配置。
		array(
		'cipher' => 'aes-256',
		'mode' => 'ecb',
		//'key' => $result -> string2,  //获取盐值2
		));
		$revise_user = $this->encryption->encrypt($revise_user);
			
			
			
			$data['data'] = $this -> admin_models -> get_uid_and_admin($revise_uid,$revise_user);
			//$data['data_uid'] = $revis_uid;
			//$data['data_user'] = $revise_user;
			$this->load->view('templates/admin_user_revise',$data);
			
			
		}catch(Exception $e){
			echo $e -> getMessage();
		}
	}
	
	public function revise_now_user()
	{
		try
		{
		//----------------
			if(!$this->login_test('ajax'))
			{
				throw new Exception('error, please try again.');
			}elseif($this->power_test()!=1)
			{
				throw new Exception('error, please try again.');
			}
			
				$this -> load -> library('form_validation');
				
				$this -> form_validation -> set_rules('uid', 'Uid', 'trim|required|min_length[1]|max_length[2]|regex_match[/^[0-9]{1,2}$/]');
				$this -> form_validation -> set_rules('user', '用户名', 'trim|required|min_length[3]|max_length[16]|regex_match[/^[\w\@\#\$\%]+[ \·\w\@\#\$\%]+[\w\@\#\$\%]{2,17}$/]');
				$this -> form_validation -> set_rules('first_pass', '密码', 'min_length[6]|max_length[24]|regex_match[/^[ \w[:punct:]]{5,25}$/]');
				$this -> form_validation -> set_rules('verify_pass', '确认密码', 'min_length[6]|max_length[24]|matches[first_pass]|regex_match[/^[ \w[:punct:]]{5,25}$/]');
		
				$this -> form_validation -> set_message('required', '{field},required');
				$this -> form_validation -> set_message('regex_match', '{field},regex_match');
				$this -> form_validation -> set_message('min_length', '{field},min_length');
				$this -> form_validation -> set_message('max_length', '{field},max_length');
			
				if ($this -> form_validation -> run() == TRUE) 
				{
					$uid = $this->input->post('uid');
					$user = $this->input->post('user');
					$pw = $this->input->post('first_pass');
					$pw2 = $this->input->post('verify_pass');
					$power = $this->input->post('power');
				}else{
					if (validation_errors() != null) 
					{
					throw new Exception('error.0');
					}
				}

				switch ($power) 
				{
					case "系统管理员" :
						$a_power = "1";
						break;
					case "网站管理员" :
						$a_power = "2";
						break;
					case "普通管理员" :
						$a_power = "3";
						break;
					default :
						$a_power = "0";
				}
			
		$this->encryption->initialize(//加密算法，模式，key配置。
		array(
		'cipher' => 'aes-256',
		'mode' => 'ecb',
		//'key' => $result -> string2,  //获取盐值2
		));
			
			if(empty($pw))
			{
				$a_uid = $uid;
				$a_un = $this->encryption->encrypt($user);
				$result = $this -> admin_models -> revise_admin_user_data($a_uid,$a_un,$a_power);
				echo "Revise Complete.0";
			}else if($pw=$pw2){
				$a_uid = $uid;
				$a_un = $user;
				$a_pw = $this -> password_hash($pw);
				$result = $this -> admin_models -> revise_admin_user_data_move($a_uid,$a_un,$a_power,$a_pw);
				echo "Revise Complete.1";
			}else{
				throw new Exception('请输入正确的用户名或密码.rnu');
			}
			
		//----------------
		}catch(Exception $e){
			echo $e -> getMessage();
		}
	}

	private function password_hash($pw)
	{
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
	
	public function add_admin()
	{
	  try
	  {
		//--------------
		if(!$this->login_test('ajax'))
		{
			throw new Exception('error, please try again.');
		}elseif($this->power_test()!=1)
		{
			throw new Exception('error, please try again.');
		}
		
		//
		$this -> load -> library('form_validation');
		
		$this -> form_validation -> set_rules('user', '用户名', 'trim|required|min_length[3]|max_length[16]|regex_match[/^[\w\@\#\$\%]+[ \·\w\@\#\$\%]+[\w\@\#\$\%]{2,17}$/]');
		$this -> form_validation -> set_rules('first_pass', '密码', 'required|min_length[6]|max_length[24]|regex_match[/^[ \w[:punct:]]{5,25}$/]');
		$this -> form_validation -> set_rules('verify_pass', '确认密码', 'required|min_length[6]|max_length[24]|matches[first_pass]|regex_match[/^[ \w[:punct:]]{5,25}$/]');
		
		$this -> form_validation -> set_message('required', '{field},required');
		$this -> form_validation -> set_message('regex_match', '{field},regex_match');
		$this -> form_validation -> set_message('min_length', '{field},min_length');
		$this -> form_validation -> set_message('max_length', '{field},max_length');
		if ($this -> form_validation -> run() == TRUE) 
		{
			$user = $this->input->post('user');
			$pw = $this->input->post('first_pass');
			$pw2 = $this->input->post('verify_pass');
			$power = $this->input->post('power');
		}else{
			if (validation_errors() != null) 
			{
				throw new Exception('请输入正确的用户名或密码.add');
			} 
		}
		

			switch ($power) 
				{
					case "系统管理员" :
						$power = "1";
						break;
					case "网站管理员" :
						$power = "2";
						break;
					case "普通管理员" :
						$power = "3";
						break;
					default :
						$power = "0";
				}
		//
	
		
		$this->encryption->initialize(//加密算法，模式，key配置。
		array(
		'cipher' => 'aes-256',
		'mode' => 'ecb',
		//'key' => $result -> string2,  //获取盐值2
		));
		$un = $this->encryption->encrypt($user);
		$username = $this->admin_models->get_admin($un);  //查询数用户名在数据库中是否存在
		if($username != NULL)
		{
			throw new Exception('用户已存在.');
		}
		
		if($pw === $pw2)
		{
			$pw = $this -> password_hash($pw);
		}else{
			throw new Exception('两次的密码输入不一样.');
		}
		
		$a_un = $un;
		$a_pw = $pw;
		$a_power = $power;
		
		$this -> admin_models -> inset_admin_user($a_un,$a_pw,$a_power);
		
		$add_check = $this -> admin_models ->get_admin($a_un);
		if(isset($add_check))
		{
			echo "添加成功。";
		}else{
			throw new Exception('Failed, please try again.');
		}
		
		
		//--------------
	  }catch(Exception $e){
		echo $e -> getMessage();
	  }
	}

	public function remove_admin_data()
	{
	try{
			if(!$this->login_test('ajax'))
			{
				throw new Exception('error, please try again.');
			}else if($this->power_test()!=1)
			{
				throw new Exception('error, please try again.');
			}
			
			$get_uid = $this->input->post('uid');
			$get_user = $this->input->post('user');
			
			$rule_uid = '/[0-9]+/';
			$rele_user = '/^[\w\@\#\$\%]+[ \·\w\@\#\$\%]+[\w\@\#\$\%]{2,17}$/';
			preg_match_all($rule_uid,$get_uid,$uid,PREG_PATTERN_ORDER);
			preg_match_all($rele_user,$get_user,$user,PREG_PATTERN_ORDER);
			
			
			
			if (isset($uid[0]) && isset($user[0])) 
			{
				$remove_uid = $uid[0][0];
				$remove_user = $user[0][0];
				
			}elseif (validation_errors() != null) 
			{
				throw new Exception('请输入正确的用户名或密码.del');
			}
			
		$this->encryption->initialize(//加密算法，模式，key配置。
		array(
		'cipher' => 'aes-256',
		'mode' => 'ecb',
		//'key' => $result -> string2,  //获取盐值2
		));
		$remove_user = $this->encryption->encrypt($remove_user);
		
		$remove_check = $this->admin_models->get_uid_and_admin($remove_uid,$remove_user);
		
		if(isset($remove_check))
		{
			$this->admin_models->remove_admin_data($remove_uid,$remove_user);
			echo "已删除".$user[0][0];
		}else{
			throw new Exception('Del error.');
		}
		
		}catch(Exception $e){
			echo $e -> getMessage();
		}
	}


	public function add_keycode()
	{
		//$num = random_int(16,24);
		$num = "12";
		$bytes = bin2hex(random_bytes($num));
		$result = $this->admin_models->get_keycode_check($bytes);
		if(empty($result))
		{
			$this->admin_models->inset_keycode($bytes);
			echo $bytes;
		}else{
			$this->add_keycode();
		}

	}

	public function remove_keycode()
	{
		try
		{
		$keycode = $this->input->post('key');
		$result = $this->admin_models->get_keycode_check($keycode);
		if (isset($result))
		{
			if($result[0]['state_code'] == 0 )
			{
				$this->admin_models->remove_keycode($keycode);
				//print_r($result);
				echo "删除成功";
			}else{
				throw new Exception('This code has been used.');
				//echo $result['state_code'];
			}
		}else{
			throw new Exception('Not found this code.');
		}
		
		}catch(Exception $e){
			echo $e -> getMessage();
		}
	}







	public function test()
	{
			$uid = $this->input->post('uid');
			$user = $this->input->post('user');
			$pw = $this->input->post('first_pass');
			$pw2 = $this->input->post('verify_pass');
			$power = $this->input->post('power');
			
			if(isset($pw)&&isset($pw2)&&isset($power))
			{
				echo $uid.$user.$pw.$pw2.$power;
			}else{
				echo "0";
			}
	}
}
?>