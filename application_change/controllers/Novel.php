<?php
class Novel extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('page_models');
        $this->load->helper('url_helper');
		$this->load->library('encryption');
		$this->load->library('session');
		
    }

    public function index($page = 'novel_list',$header_num = "")
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

    
    
	$this->load->view('head_file_in/novel_style');
    $this->load->view('pages/header', $data);

    $this->load->view('templates/'.$page, $data);
    $this->load->view('pages/footer', $data);
    }
	
	public function novel ($pages = 'novel')
    {
    	
		$this->index($pages);
		
    }
	
	public function nn ($pages = 'nn')
    {
    	
		$this->load->view('templates/'.$page);
		
    }
	
}
?>