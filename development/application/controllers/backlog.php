<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backlog extends CI_Controller{
	private $date_format = 'Y-m-d';
	
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Backlog_model','bklg');
		$this->load->model('Menu','menu');
	}
	
	private function template($data){
		$data['group'] = (int) 1;
		$data['menu'] = $this->menu->get_menu($data['group']);
		$this->load->view('template',$data);
	}

	public function index(){
		$data['project'] = $this->bklg->get_projects();
		$data['page'] = 'home';
		$this->template($data);
	}
	
	public function insert($type){
		eval("\$this->insert_{$type}();");
	}
	
	private function insert_sprint(){
		$data['page'] = 'form_sprint';
		$this->template($data);
	}
	
	public function project(){
		$id = $this->input->post('project');
		$data = array(
			'backlog_id' => $id,
			'project' => $this->bklg->get_projects(),
			'sprint_backlog' => $this->bklg->get_sprint_backlogs($id),
			'page' => 'home'
		);
		$this->template($data);
	}
	
	public function save($type){
		eval("\$this->save_{$type}();");
		$this->index();
	}
	
	private function save_backlog(){
    	$data = array(
    		'complete_percentage' => 0,
    		'date' => date($this->date_format),
    		'project_name' => $this->input->post('name')
    	);
		$this->bklg->insert_backlog($data);
	}
	private function save_sbacklog(){
    	$data = array(
    		'title' => $this->input->post('title'),
    		'date' => date($this->date_format),
    		'investment' => 0,
    		'product_backlog_id' => $this->input->post('product_backlog_id')
    	);
		$this->bklg->insert_sbacklog($data);
	}
	
	private function save_slice(){
    	$data = array(
    		'title' => $this->input->post('title'),
    		'content' => $this->input->post('content'),
    		'investment' => (int) $this->input->post('investment'),
    		'product_backlog_id' => $this->input->post('product_backlog_id'),
    		'sprint_backlog_id' => $this->input->post('sprint_backlog_id'),
    		'date' => date($this->date_format)
    	);
		$this->bklg->insert_slice($data);
	}
}

/* End of file backlog.php */
/* Location: ./application/controllers/backlog.php */