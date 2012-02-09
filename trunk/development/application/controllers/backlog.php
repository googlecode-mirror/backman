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
		if(isset($_POST['project'])) $data['sprint_backlog'] = $this->bklg->get_backlog($_POST['project']);
		$this->template($data);
	}
	
	public function insert($type){
		eval("\$this->insert_{$type}();");
	}
	
	private function insert_sprint(){
		if(isset($_POST['backlog_id'])){
			if(!isset($_POST['sprint_backlog'])){
				$data['page'] = 'sprint_form';
				$data['backlog_id'] = $_POST['backlog_id'];
				$this->template($data);
			}
			else{
				$data = array(
					'date' => date('Y-m-d'),
					'product_backlog_id' => $this->input->post('backlog_id'),
					'title' => $this->input->post('title')
				);
				if($this->bklg->insert_sbacklog()) continue;
				else
					echo <<<HTML
					<script type="text/javascript">
						alert("Erro ao criar nova Sprint.");
					</script>
HTML;
				redirect(site_url('backlog/'),'location');
			}
		}
		else redirect(site_url('backlog/'),'location');
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