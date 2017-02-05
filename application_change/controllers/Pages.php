<?php
class Pages extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('page_models');
        $this->load->helper('url_helper');
		$this->load->library('encryption');
		$this->load->library('session');
		
    }


	
    public function index($page = 'demo01',$header_num = "")
    {
 if ( ! file_exists(APPPATH.'../views_change/templates/'.$page.'.php'))
    {
        // Whoops, we don't have a page for that!
        show_404();
    }
	
//	if (isset($_SESSION['username'])) {
//		$data['hpud_num'] = '1';
//	}else{
//		$data['hpud_num'] = '0';
//	}
	
	$data['ttop'] = 'mode/ttop';
	
	$data['nav_data'] = $this->page_models->get_nav_data();
	$data['nav_down_data'] = $this->page_models->get_nav_down_data();
	
	$data['header_data'] = $this->page_models->get_header_data($header_num);

	
	
    $data['title'] = ucfirst($page); // Capitalize the first letter

    
//--------------head--------------    
	$this->load->view('head_file_in/demo_style');
//-------------------------------
    $this->load->view('pages/header', $data);
	
    //$this->load->view('templates/'.$page, $data);
	//-----------------demo01----------------
	$this->load->view('templates/'.$page, $data);
	//---------------demo01 end -------------
    $this->load->view('pages/footer', $data);
    }
	
	
	
	public function view ($templates = 'about')
    {
    	
		
		$random_num = mt_rand(0, 2);
    	$this->index($templates,$random_num);
    	//第一个参数控制载入的模板页面，第二个参数控制载入的header背景图片。1表示数据库中的数据存储入数组中后，读取键值为1的数值。例 1 = bbb
		
		//$data['title'] = "My Real Title";
        //$data['heading'] = "My Real Heading";
		
		
		//$data['nav_data'] = $this->news_model->get_nav_data();
		//$data['nav_down_data'] = $this->news_model->get_nav_down_data();
		//$data['header_data'] = $this->news_model->get_header_data();
		
		//$this->load->view('pages/header', $data);
		//$this->load->view('css/mainframe.css');
		//$this->load->view('pages/navigation', $data);
		
        //$this->load->view('templates/manage_menu', $data);
		//$this->load->view('pages/footer', $data);
    }
	
	public function loginPage($massge = '')
	{
		//$data['ur'] = $this->news_model->get_user_data();
		//$data['pw'] = $this->news_model->get_password_data();
		$data['title'] = "Login";
		$data['massge'] = $massge;
		$data['errors'] = '';
		//$data['login_data'] = $this->user_models->get_login_data();
		
		$this->load->view('templates/loginPage', $data);
		
	}

}
?>